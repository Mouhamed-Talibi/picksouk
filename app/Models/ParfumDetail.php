<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ParfumDetail extends Model
    {
        protected $fillable = [
            'product_id',
            'mark',
            'volume',
            'gender',
        ];

        public function product() {
            return $this->belongsTo(Product::class);
        }
    }
