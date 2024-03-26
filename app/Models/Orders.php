<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model{    
	use HasFactory;
	protected $table = 'orders';
	protected $fillable = ['title','task','delivery_date','website_id','subject_id','task_type_id','studylabel_id','grade_id','referencing_style_id','no_of_words','price','student_id','payment_status','task_status','writer_id','qc_id','rating','review','currency_code'];
	public $timestamps = true;
}