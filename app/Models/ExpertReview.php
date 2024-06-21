<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertReview extends Model
{
    

    
    protected $table = 'experts_review';

    
    protected $fillable = [
                  'title',
                  'description',
                  'expert_id',
                  'review_date',
                  'review_code',
                  'status',
                  'title_number',
                  'star_rating_number'
              ];

    

}
