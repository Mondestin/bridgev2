<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GestionVisas extends Model
{
    protected $fillable=['avatar' ,'surname' ,'name' ,'dob' ,'pofbirth' ,'sexe' ,'nationality' ,'mother' ,'father' ,'profession' ,'taille' ,'eye_color' ,'cheuveux' ,'pa_sign' ,'addressFirstCountry' ,'addressSecondCountry' ,'tuteur' ,'phone' ,'id_number' ,'date_emission' ,'date_expiration' ,'place_emission' ,'byUser','type','status','durée','dem_status'];
    protected $date=['created_at','updated_at'];
}
