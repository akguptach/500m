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
'user_type','type','referal_link','about','location','password'];

    public function website()
	{
		return $this->belongsTo('App\Models\Website', 'website_id');
	}
}
