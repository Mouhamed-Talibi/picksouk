<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    /**
     * fillable properties for mass assignment
     */
    protected $fillable = [
        'name',
        'image', 
        'slug', 
        'description',
        'total_products',
    ];

    // relationship with products
    public function products() {
        return $this->hasMany(Product::class);
    }

    // get route key name
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
