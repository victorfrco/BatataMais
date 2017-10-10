<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price_cost', 'price_resale'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brands(){
        return $this->hasMany(Brand::class);
    }

    public function providers(){
        return $this->belongsTo(Provider::class);
    }
}
