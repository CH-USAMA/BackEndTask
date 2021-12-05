<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{      
    use HasFactory;

    protected $fillable = [
        'title',
        'superHost',
        'residentType',
        'location',
        'samplePhotoUrl',
        'guests',
        'bedrooms',
        'beds',
        'baths',
        'rating',
        'personReviewed',
        'costs'

    ];


    protected $casts = [
        'estimated_loss' => 'float',
    ];

    public function bookings()
    {
        return $this->hasMany('App\Models\Bookings');
    }
}
