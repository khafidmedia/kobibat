<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LoanRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'duration_months',
        'purpose',
        'bank_account',
        'bank_name',
        'account_holder',
        'notes',
        'agreed',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
