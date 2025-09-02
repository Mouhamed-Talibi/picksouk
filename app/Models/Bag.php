<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bag extends Model
{
    use SoftDeletes;

    // fillables
    protected $fillable = [
        'brand',
        'weight',
        'color',
        'size',
        'external_material',
        'product_id'
    ];

    // relashionships with product
    public function products() {
        return $this->belongsTo(Product::class);
    }
}
