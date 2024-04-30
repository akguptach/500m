<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['service_name', 'service_description', 'website_type', 'status', 'short_description'];

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

    public function howWorks()
    {
        return $this->hasMany('App\Models\ServiceHowWork', 'service_id');
    }

    public function assistBtns()
    {
        return $this->hasMany('App\Models\ServiceAssistButton', 'service_id');
    }

    public function whyEducrafter()
    {
        return $this->hasMany('App\Models\ServiceWhyEducrafter', 'service_id');
    }
}
