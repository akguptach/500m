<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherOrderMessage extends Model
{
    use HasFactory;
    protected $table = 'teacher_order_messages';
    protected $fillable = ['sender_id', 'receiver_id', 'order_id', 'message', 'attachment'];



    public function sendertable()
    {
        return $this->morphTo();
    }

    public function receivertable()
    {
        return $this->morphTo();
    }
}
