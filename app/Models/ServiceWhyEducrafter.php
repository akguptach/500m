<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceWhyEducrafter extends Model
{
    use HasFactory;
    protected $table = 'service_why_educrafter';
    protected $fillable = ['title', 'description', 'icon', 'service_id'];
}
