<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Clothes extends Model
    {
        // fillables
        protected $fillable = [
            'product_id',
            'gender',
            'age',
            'age_group',
            'brand',
            'size',
        ];

        // relashionship with product table
        public function products() {
            return $this->belongsTo(Product::class);
        }
    }
