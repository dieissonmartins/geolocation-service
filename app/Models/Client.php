<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

/**
 * @property \Grimzy\LaravelMysqlSpatial\Types\Point   $location
 * @property \Grimzy\LaravelMysqlSpatial\Types\Polygon $area
 */
class Client extends Model
{
    use SpatialTrait;

    protected $fillable         = ['name','status','location'];

    protected $spatialFields    = ['location'];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [ 
        'created_at'    => 'datetime:d/m/Y H:y:s',
        'updated_at'    => 'datetime:d/m/Y H:y:s'
    ];
}