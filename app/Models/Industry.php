<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
  use HasFactory;
  protected $primaryKey='id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function portfolio()
  {
      return $this->hasMany('App\Portfolio','industry_id');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'industry_name', 'industry_icon'
  ];
}
