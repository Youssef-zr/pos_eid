<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $guarded = [];

    // the order of client
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    // products relation many to many
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('quantity');
    }
}
