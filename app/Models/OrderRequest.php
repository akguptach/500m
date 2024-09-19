<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    use HasFactory;
    protected $table = 'order_request';
    protected $fillable = ['order_id', 'student_id', 'tutor_id', 'message', 'admin_id', 'delivery_date', 'status', 'type'];

    public function tutor()
    {
        return $this->belongsTo('App\Models\Tutor', 'tutor_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Orders', 'order_id');
    }

}
