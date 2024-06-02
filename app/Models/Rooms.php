<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservations;
class Rooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'name',
        'description',
        'file_path',
        'type',
        'status',
        'price'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'room_id');
    }
}
