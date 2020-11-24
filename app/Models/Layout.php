<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function page()
    {
        return $this->belongsTo('App\Page','page_id');
    }
    public function building_block()
    {
        return $this->hasMany('App\BuildingBlock','building_block_id');
    }
    public function layout()
    {
        return $this->hasMany('App\Layout','page_id');
    }

    protected $fillable = [
        'id', 'page_id', 'building_block_id', 'layout_order'
    ];
}
