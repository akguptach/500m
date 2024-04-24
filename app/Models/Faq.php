<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'faq';
    protected $fillable = ['question', 'answer'];


    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }
}