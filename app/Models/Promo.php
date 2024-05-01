<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','promo_discount','startdate','enddate'];

    public function product() 
     {
        return $this->belongsTo(Product::class);
    }
}
