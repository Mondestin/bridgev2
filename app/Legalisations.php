<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legalisations extends Model
{
   protected $fillable=['citoyen_no' ,'school_name' ,'type' ,'place_emission' ,'date_delivrance','document','status','name','surname','phone','email', 'type_legalisation'];
    protected $date=['created_at','updated_at'];
}
