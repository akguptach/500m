<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentWithdrawal extends Model
{
    use HasFactory;
    protected $table = 'student_withdrawals';
    protected $fillable=[
        'student_id',
        'amount',
        'status',
        'remarks'
    ];
     

    public function student()
	{
		return $this->belongsTo('App\Models\Student', 'student_id');
	}
}
