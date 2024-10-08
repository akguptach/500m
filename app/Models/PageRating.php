<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageRating extends Model
{
    use HasFactory;
    protected $fillable = ['page_id', 'star_rating', 'description', 'user_image', 'address'];
}
