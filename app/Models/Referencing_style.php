<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencing_style extends Model
{
    use HasFactory;
    protected $table = 'referencing_style';
    protected $fillable = ['style'];
}
