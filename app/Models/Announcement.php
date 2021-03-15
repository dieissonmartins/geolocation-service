<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'adverts';

    protected $fillable   = ['client_id','description','image','start_date','final_date','qtd_view'];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [ 
        'created_at'    => 'datetime:d/m/Y H:y:s',
        'updated_at'    => 'datetime:d/m/Y H:y:s',
        'start_date'    => 'datetime:d/m/Y H:y:s',
        'final_date'    => 'datetime:d/m/Y H:y:s'
    ];
}