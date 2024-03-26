<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level_study extends Model
{
    use HasFactory;
    protected $table = 'level_study';
    protected $fillable = ['level_name','price'];
}
