<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'dob',
        'state_of_origin',
        'lga',
        'occupation',
        'bank_name',
        'account_number',
        'account_name',
        'passport_path',
        'valid_id_path',
        'nok_name',
        'nok_phone',
        'nok_email',
        'nok_address',
        'referral_source',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
