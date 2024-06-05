<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'code',
                  'start_date',
                  'end_date',
                  'whole_order_coupon',
                  'max_product_instances',
                  'max_uses',
                  'num_uses',
                  'reduction_target',
                  'reduction_type',
                  'reduction_amount',
                  'limit_per_users'
              ];

    

}
