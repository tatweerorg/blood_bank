<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'Username', 'Email', 'Password', 'UserType',
    ];

    // Automatically hash the password before saving it
  
    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = bcrypt($value);
    }
    public function profile()
{
    return $this->hasOne(UserProfile::class, 'user_id');
}

}
