<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Payment extends Model
    {
        use SoftDeletes;

        // fillbales 
        protected $fillable = [
            'order_id',
            'product_id',
            'client_name',
            'order_price',
        ];

        // relashionship with products
        public function product() {
            return $this->belongsTo(Product::class);
        }
    }
