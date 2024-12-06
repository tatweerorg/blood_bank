<?php

namespace App\Models;

use App\Models\User;
use App\Models\BloodRequestCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BloodRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'BloodType',
        'Quantity',
        'RequestDate',
        'Status'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function bloodRequestCenters(){
        return $this->hasMany(BloodRequestCenter::class, 'blood_request_id');
    }
}
