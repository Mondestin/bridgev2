<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deces extends Model
{
    protected $fillable=[ 'surname',
            'name',
            'status',
            'date_of_birth',
            'place',
            'sexe',
            'time',
            'f_name',
            'f_surname',
            'f_age',
            'f_profession',
            'f_adress',
            'm_name',
            'm_surname',
            'm_age',
            'm_profession', 
            'm_adress',
            'd_name',
            'd_surname',
            'd_age',
            'd_profession',
            'd_adress',
            'deces_date',
            'declare_date',
            'relation',
            'c_name',
            'c_surname',
            'heure_deces',
            'place_deces',
            'situation',
            'domicile',
            'byUser',
            'profession',];
    protected $date=['created_at','updated_at'];
}
