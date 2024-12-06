<?php

namespace App\Models;

use App\Models\BloodRequestCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BloodRequestCenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'blood_request_id',
        'center_id'

    ];
    public function bloodRequest(){
        return $this->belongsTo(BloodRequest::class, 'blood_request_id');

    }
    public function center(){
        return $this->belongsTo(User::class,'user_id');
    }
    
}
