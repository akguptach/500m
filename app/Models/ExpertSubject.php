<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertSubject extends Model
{
    use HasFactory;
    protected $table = 'expert_subjects';
    protected $fillable = ['expert_id', 'subject_id','subject_number'];

    public function subject()
    {
        return $this->belongsTo('App\Models\ExpertSubject', 'expert_id');
    }
}
