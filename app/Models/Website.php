<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function portfolio_website()
    {
        return $this->hasMany('App\PortfolioWebsite','website_id');
    }
    public function page()
    {
        return $this->hasMany('App\Page','website_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'website_name', 'website_slug', 'website_url'
    ];
}
