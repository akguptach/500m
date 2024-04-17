<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['service_name', 'service_description', 'website_type', 'status'];

    public function seo()
    {
        return $this->hasOne('App\Models\ServiceSeo', 'service_id');
    }
    
    

    public function faq()
    {
        return $this->hasMany('App\Models\ServiceFaq', 'service_id');
    }

    public function specification()
    {
        return $this->hasMany('App\Models\ServiceSpecification', 'service_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\ServiceRating', 'service_id');
    }
}
