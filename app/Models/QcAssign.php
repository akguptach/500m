<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcAssign extends Model
{
    use HasFactory;
    protected $table = 'qc_assign';

    public function qc()
    {
        return $this->belongsTo('App\Models\Tutor', 'qc_id');
    }
}
