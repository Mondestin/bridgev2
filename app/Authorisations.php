<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorisations extends Model
{
    protected $fillable=[ 'citoyen_id',
            'relation_parent',
            'child_surname',
            'child_name',
            'b_surname',
            'b_name',
            'b_id_number',
            'b_adresse',
            'b_contact',
            'relation_parent_2',
            'pouvoir',
            'status',
            'b_id_etablit',
            'b_id_expire',
            'byUser'
          ];
    protected $date=['created_at','updated_at'];
}
