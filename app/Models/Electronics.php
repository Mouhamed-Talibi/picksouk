<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Electronics extends Model
    {
        use SoftDeletes;

        protected $fillable = [
            'product_id',
            'ram',
            'storage',
            'processor',
            'camera',
            'weight',
            'screen_size',
            'brand',
            'operating_system',
        ];

        // product relashionship
        public function product() {
            return $this->belongsTo(Product::class);
        }
    }
