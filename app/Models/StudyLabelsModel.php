<?php

namespace App\Models;use Illuminate\Database\Eloquent\Factories\HasFactory;use Illuminate\Database\Eloquent\Model;class StudyLabelsModel extends Model{
    use HasFactory;
    protected $table = 'study_labels';
    protected $fillable = ['label_name','price'];
}
