<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPaymentMethods extends Model
{
    use HasFactory;
    protected $table = 'student_payment_methods';
    protected $fillable=[
        'student_id',
        'bank_name',
        'account_no',
        'branch',
        'ifsc_code',
        'default_payment',
        'upi_id',
        'account_holder_name'



    ];
}
