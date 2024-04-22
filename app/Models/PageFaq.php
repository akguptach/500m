<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageFaq extends Model
{
    use HasFactory;
    protected $table = 'page_faq';
    protected $fillable = ['page_id', 'question', 'answer'];
}
