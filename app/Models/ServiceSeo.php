<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSeo extends Model
{
    use HasFactory;
    protected $table = 'service_seo';

    protected $fillable = ['service_id', 'seo_title', 'seo_keyword', 'seo_url_slug', 'seo_meta', 'seo_description'];
}
