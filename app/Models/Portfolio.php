<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
  use HasFactory;
  protected $primaryKey='id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function category()
  {
      return $this->belongsTo('App\Category','category_id');
  }
  public function industry()
  {
      return $this->belongsTo('App\Industry','industry_id');
  }
  public function portfolio_website()
  {
      return $this->hasMany('App\PortfolioWebsite','portfolio_id');
  }
  public function portfolio_image()
  {
      return $this->hasMany('App\PortfolioImage','portfolio_id');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'category_id', 'industry_id', 'title', 'sub_title', 'body_text'
  ];
}
