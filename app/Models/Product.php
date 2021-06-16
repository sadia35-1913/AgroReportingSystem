<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'quantity',
        'seller_id',
    ];

    public function orders(){
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    // if product is deleted than auto delete depended data
    public static function boot() {
        parent::boot();
        static::deleting(function($product) {
            $product->orders()->delete();
        });
    }
}
