<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_referrals',
        'min_sales',
        'benefits',
        'icon_path',
    ];

    protected $casts = [
        'min_sales' => 'decimal:2',
        'benefits' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
