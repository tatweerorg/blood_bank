<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'center_id',
        'blood_type',
        'quantity',
        'last_donation_date',
        'Status'
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function center()
{
    return $this->belongsTo(User::class, 'center_id');
}

}
