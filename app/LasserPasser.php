<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LasserPasser extends Model
{
    protected $fillable=['id_number','laisse_no' ,'date_emission' ,'date_expiration' ,'place_emission' ,'byUser','link_with'];
    protected $date=['created_at','updated_at'];
}
