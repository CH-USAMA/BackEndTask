<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{ 
 
    use HasFactory;

    protected $fillable = [
        'email',
        'rooms_id',
        'no_of_days',
        'time',
        

    ];

    public function rooms()
    {
        return $this->belongsTo('App\Models\Rooms');
    }
}
