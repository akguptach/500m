<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table='payment';


    public function order()
    {
        return $this->belongsTo('App\Models\Orders', 'order_id');
    }

}
