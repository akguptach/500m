<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Pages extends Model	{
		use HasFactory;
		protected $table = 'pages';		
		protected $fillable = [
		'page_title',
		'page_desc',
		'seo_title',
		'seo_url_slug',
		'seo_description',
		'seo_keywords',
		'seo_meta',
		'status',
		];
    public $timestamps = true;
	
	protected function generateSlug($name){ 
	
	if (static::whereSeo_url_slug($seo_url_slug = Str::slug($name))->exists()){
		$max = static::whereSeo_title($name)->latest('id')->skip(1)->value('seo_url_slug');
		if (isset($max[-1]) && is_numeric($max[-1])) { 
			return preg_replace_callback('/(\d+)$/', function($mathces) { 
				return $mathces[1] + 1;
			}, $max);
		}
		return "{$seo_url_slug}-2";
	}
	return $seo_url_slug;
	}    
}

