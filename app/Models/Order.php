<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Order extends Model
    {
        // soft deletes 
        use SoftDeletes;

        // fillables
        protected $fillable = [
            'product_id',
            'client_id',
            'product_name',
            'client_name',
            'client_address',
            'client_phone',
            'city',
            'quantity',
            'total_price',
        ];

        // relashionship with users
        public function client() {
            return $this->belongsTo(User::class);
        }

        // relashion ship with products
        public function product() {
            return $this->belongsTo(Product::class);
        }
    }
