<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable = ['room_id', 'user_id', 'check_in', 'check_out', 'total_person', 'total_price', 'status'];

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public static function isAvailable($room_id, $check_in, $check_out)
    {
        return !self::where('room_id', $room_id)
            ->where('status', 0)
            ->where(function ($query) use ($check_in, $check_out) {
                $query->where(function ($query) use ($check_in, $check_out) {
                    $query->where('check_in', '<', $check_out)
                          ->where('check_out', '>', $check_in);
                });
            })->exists();
    }
}
