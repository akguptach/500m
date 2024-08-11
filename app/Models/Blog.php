<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function generateSkuFromTitle;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    public function setBlogTitleAttribute($value)
    {
        // Automatically set the title attribute
        $this->attributes['blog_title'] = $value;

        // Automatically generate and set the SKU attribute based on the title
        $this->attributes['blog_sku'] = generateSkuFromTitle($value);
    }

    public function website()
	{
		return $this->belongsTo('App\Models\Website', 'website_id');
	}

    public function category()
	{
		return $this->belongsTo('App\Models\BlogCategory', 'category_id');
	}

}