<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procurations extends Model
{
    protected $fillable=[ 
            'citoyen_id',
            'b_surname',
            'b_name',
            'b_id_number',
            'b_adresse',
            'b_contact',
            'pouvoir',
            'status',
            'b_id_etablit',
            'b_id_expire',
            'byUser'
          ];
    protected $date=['created_at','updated_at'];
}
