<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";
    protected $guarded = [];

    // client orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id', 'id');
    }
}
