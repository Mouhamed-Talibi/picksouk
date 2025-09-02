<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Product extends Model
    {
        use SoftDeletes;

        /**
         * fillable properties for mass assignment
         */
        protected $fillable = [
            'name',
            'slug',
            'description_title',
            'description',
            'price',
            'old_price',
            'stock',
            'category_id',
        ];

        // relationship with category
        public function category() {
            return $this->belongsTo(Category::class);
        }

        // relashionship with parfumDetails
        public function parfumDetails() {
            return $this->hasOne(ParfumDetail::class);
        }

        // relashionship with electronics
        public function electronicsDetails() {
            return $this->hasOne(Electronics::class);
        }

        // relashionship with clothes
        public function clothesDetails() {
            return $this->hasOne(Clothes::class);
        }

        // relashionship with health and beauty 
        public function health_beauty_Details() {
            return $this->hasOne(HealthAndBeauty::class);
        }

        // relashionship with product_images
        public function images() {
            return $this->hasMany(ProductImage::class);
        }

        // relashionship with orders
        public function orders() {
            return $this->hasMany(Order::class);
        }

        // relashionship with bags
        public function bagsdetails() {
            return $this->hasOne(Bag::class);
        }
    }
