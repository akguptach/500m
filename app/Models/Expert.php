<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'experts';

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
                  'first_name',
                  'competences',
                  'description',
                  'image',
                  'language',
                  'online_status',
                  'paper_number',
                  'qualification',
                  'rating_numbers',
                  'subject',
                  'subject_number',
                  'success_rate',
                  'total_orders',
                  'type_of_paper',
                  'status',
                  'website_type'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    

    public function subjects()
    {
        return $this->hasMany('App\Models\ExpertSubject', 'expert_id');
    }

    public function papers()
    {
        return $this->hasMany('App\Models\ExpertPaper', 'expert_id');
    }



}
