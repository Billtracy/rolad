<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'installment_plan_id',
        'due_date',
        'amount_due',
        'amount_paid',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'amount_due' => 'decimal:2',
        'amount_paid' => 'decimal:2',
    ];

    public function plan()
    {
        return $this->belongsTo(InstallmentPlan::class, 'installment_plan_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
