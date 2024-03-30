<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcOrderRequest extends Model
{
    use HasFactory;
    protected $table = 'qc_order_request';
    protected $fillable = ['order_id', 'student_id', 'qc_id', 'message', 'admin_id', 'delivery_date'];
}
