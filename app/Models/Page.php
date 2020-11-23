<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function website()
    {
        return $this->belongsTo('App\Website','website_id');
    }
    public function seo_tag()
    {
        return $this->hasMany('App\SeoTag','page_id');
    }
    public function layout()
    {
        return $this->hasMany('App\Layout','page_id');
    }

    protected $fillable = [
        'id', 'website_id', 'parent_page_id', 'page_name'
    ];
}
