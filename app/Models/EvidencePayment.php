<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidencePayment extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id','status','reason','url'];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
