<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'star_rating', 'description', 'user_image', 'address'];
}
