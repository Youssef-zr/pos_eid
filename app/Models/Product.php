<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = "products";
    public $translatedAttributes = ['title', "description"];
    protected $translationForeignKey = 'product_id';
    protected $guarded = ["image"];


    public function getImageAttribute()
    {
        $image = $this->photo;

        if ($image == "default.png") {
            $storagePath = "assets/dist/storage/products/";
            $this->photo = $storagePath . $image;
        }

        return url($this->photo);
    }

    // orders relation many to many
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }
}
