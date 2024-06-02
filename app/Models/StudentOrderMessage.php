<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOrderMessage extends Model
{
    use HasFactory;
    protected $table = 'student_order_messages';
    protected $fillable = ['sendertable_id', 'sendertable_type', 'receivertable_id', 'receivertable_type', 'order_id', 'message', 'attachment', 'read','url'];



    public function sendertable()
    {
        return $this->morphTo();
    }

    public function receivertable()
    {
        return $this->morphTo();
    }

    /*
    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }
    */
}