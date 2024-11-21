<?php

namespace App\Models;

use App\Models\User;
use App\Models\BloodCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BloodInventory extends Model
{
    
    use HasFactory;
    protected $fillable = ['center_id', 'BloodType', 'Quantity', 'ExpirationDate'];
    public function center(){
        return $this->belongsTo(User::class,'center_id');
    }
    
}
