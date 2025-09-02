<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class HealthAndBeauty extends Model
    {
        // table name
        protected $table = "health_beauty";

        // fillables
        protected $fillable = [
            'product_id',
            'brand',
            'skin_type',
            'gender',
            'has_fragrance'
        ];

        // relashionship with product
        public function products() {
            return $this->belongsTo(Product::class);
        }
    }
