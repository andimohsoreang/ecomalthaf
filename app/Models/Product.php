<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['productname',
    'productcode',
    'productname',
    'price',
    'brand_id',
    'productweight',
    'subcategory_id',
    'stock',
    'desc',
    'isActive',
    ];


    public function subcategory() 
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function productpictures() {
        return $this->hasMany(ProductPictures::class);
    }

    public function detailtransaction()
    {
        return $this->hasMany(DetailsTransaction::class);
    }

    public function promo()
    {
        return $this->hasMany(Promo::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

}
