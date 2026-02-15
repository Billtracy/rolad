<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'email',
        'phone',
        'type',
        'preferred_date',
        'message',
        'status',
        'payment_reference',
        'payment_status',
        'amount_paid',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
