<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transactions';
    protected $fillable = [
        'user_id', 
        'order_id', 
        'referral_id',
        'amount',
        'type',
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order'::class, 'order_id');
    }

    public function referral()
    {
        return $this->belongsTo('App\Models\Referral'::class, 'referral_id');
    }
}
