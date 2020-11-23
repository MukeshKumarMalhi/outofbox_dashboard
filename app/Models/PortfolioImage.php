<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio','portfolio_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'portfolio_id', 'image_url', 'image_name', 'image_type', 'image_size'
    ];
}
