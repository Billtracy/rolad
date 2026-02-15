<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'amount',
        'reference',
        'status',
        'payment_method',
        'description',
        'proof_of_payment',
        'installment_plan_id',
        'installment_id',
    ];

    public function installmentPlan()
    {
        return $this->belongsTo(InstallmentPlan::class);
    }

    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
