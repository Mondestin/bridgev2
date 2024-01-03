<?php

namespace App;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class GestionsCitoyens extends Model
{

    protected  $table="gestions_citoyens";
    protected $fillable=['avatar','citoyen_no' ,'surname' ,'name' ,'dob'
    ,'pofbirth' ,'sexe' ,'nationality' ,'mother' ,'father' ,'profession' ,
    'coutume' ,'taille' ,'eye_color' ,'cheuveux' ,'pa_sign' ,'addressFirstCountry'
    ,'addressSecondCountry' ,'tuteur' ,'phone' ,'id_number' ,'date_emission' ,'date_expiration'
    ,'place_emission' ,'byUser','email','id_status','id_status', 'id_type', 'id_doc'];


    protected $date=['created_at','updated_at'];

    protected function getDobAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
