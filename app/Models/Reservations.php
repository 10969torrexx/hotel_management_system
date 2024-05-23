<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable = ['room_id', 'user_id', 'check_in', 'check_out', 'total_person', 'total_price', 'status'];
}
