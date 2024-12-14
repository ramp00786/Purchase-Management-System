<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Paper extends Model
{
    use HasFactory;

    // Add 'user_id' to the fillable property
    protected $fillable = [
        'title', 
        'gender', 
        'description', 
        'images', 
        'pdf', 
        'user_id', // Add user_id here
    ];

    // If you have file attributes that should be cast to array
    protected $casts = [
        'images' => 'array', // Example if you're storing images as JSON in the database
    ];
}
