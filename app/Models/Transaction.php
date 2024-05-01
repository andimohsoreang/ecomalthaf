<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','numinvoice'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detailtransaction()
    {
        return $this->hasMany(DetailsTransaction::class);
    }

    public function evidencepayment()
    {
        return $this->hasMany(EvidencePayment::class);
    }
}
