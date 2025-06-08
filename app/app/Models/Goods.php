<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $fillable = [
        'store_id', 'name', 'weight', 'image'
    ];

    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }
}
