<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'student';
    protected $fillable = ['first_name', 'last_name', 'email', 'status', 'phone_number',
'user_type','type','referral_code','about','location','password','website_id','commission'];

    public function website()
	{
		return $this->belongsTo('App\Models\Website', 'website_id');
	}


    public function payment_method()
	{
		return $this->hasOne('App\Models\StudentPaymentMethods', 'student_id');
	}

    public function wallet_transactions()
	{
		return $this->hasMany('App\Models\WalletTransaction', 'user_id');
	}

}
