<?php

namespace App\Models;

use App\Models\BloodInventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BloodCenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'CenterName',
        'Address',
        'ContactNumber',
    ];
 
}
