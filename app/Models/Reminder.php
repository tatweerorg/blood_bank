<?php

namespace App\Models;

use App\Models\Reminder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable=[
        'sender_id',
        'reciever_id',
        'reminder_date',
        'status',
        'reminder',
    ];
    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}

public function reciever()
{
    return $this->belongsTo(User::class, 'reciever_id');
}

}
