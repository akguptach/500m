<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertPaper extends Model
{
    use HasFactory;
    protected $table = 'expert_papers';
    protected $fillable = ['expert_id', 'type_of_paper','paper_number'];

    
}
