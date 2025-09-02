<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    // fillable fields
    protected $fillable = [
        'id',
        'full_name',
        'email',
        'rating',
        'comment',
    ];
}
