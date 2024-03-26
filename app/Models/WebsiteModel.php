<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;class WebsiteModel extends Model
{
    use HasFactory;
    protected $table ='websites';
    protected $fillable = ['website_name','person_name','email','mobile_no','price'];
}
