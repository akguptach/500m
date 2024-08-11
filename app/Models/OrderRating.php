<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRating extends Model
{
    use HasFactory;
    protected $table='order_ratings';
    protected $fillable = ['order_id', 'student_id', 'ratings','review'];

    
}