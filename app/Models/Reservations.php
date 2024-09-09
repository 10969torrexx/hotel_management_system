<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id', 
        'user_id', 
        'check_in', 
        'check_out', 
        'total_person', 
        'total_price', 
        'status',
        'extended_flg',
        'extended_date',
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public static function isAvailable($room_id, $check_in, $check_out)
    {
        if (!self::exists()) {
            return false;
        }
        //TODO: Proceed with the operation if data exists
        return self::where('room_id', $room_id)
        ->where(function ($query) use ($check_in, $check_out) {
            $query->where('check_in', '<', $check_out)
                  ->where('check_out', '>', $check_in);
        })
        ->exists();
    }

    public static function getAccepted($user_id)
    {
        return self::where('reservations.status', 1)
        ->where('reservations.user_id', $user_id)
        ->where('reservations.check_out', '<=', date('Y-m-d'))
        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
        ->select('reservations.*', 'rooms.*') // Select columns from both tables
        ->first();
    }

    public static function extendCheckout($id, $check_out)
    {
        return self::where('id', $id)
        ->update([
            'check_out' => $check_out,
            'extended_flg' => 1,
            'extended_date' => date('Y-m-d')
        ]);
    }
}
