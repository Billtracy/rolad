<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'price',
        'inspection_fee',
        'type',
        'status',
        'features',
        'images',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'price' => 'decimal:2',
            'inspection_fee' => 'decimal:2',
        ];
    }

    protected function images(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function ($value) {
                if (is_array($value)) return $value;
                return json_decode($value ?? '[]', true) ?: [];
            },
            set: fn ($value) => is_array($value) ? json_encode($value) : $value,
        );
    }

    protected function features(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function ($value) {
                if (is_array($value)) return $value;
                return json_decode($value ?? '[]', true) ?: [];
            },
            set: fn ($value) => is_array($value) ? json_encode($value) : $value,
        );
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
