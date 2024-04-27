<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAssistButton extends Model
{
    use HasFactory;
    protected $fillable = ['btn_text', 'btn_url', 'service_id'];
}