<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingBlock extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function layout()
    {
        return $this->hasMany('App\Layout','building_block_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'building_block_name', 'building_block_items', 'building_block_html_code'
    ];
}
