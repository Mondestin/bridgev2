<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mariage extends Model
{
    protected $fillable=['status','mri_surname','mri_name','mri_profession','mri_dob','mri_pere','mri_mere','mri_domicile','mri_auto_judi','mri_auto_parent','mri_dispense_age','fem_surname','fem_name','fem_profession','fem_dob','fem_pere','fem_mere','fem_domicile','fem_auto_judi','fem_auto_parent','fem_dispense_age','t1_surname','t1_name','t1_profession','t1_domicile','t1_majeur','t2_surname','t2_name','t2_profession','t2_domicile','t2_majeur','it_surname','it_name','it_profession','it_domicile','it_majeur','date_mariage','heure_mariage','byUser'];
    protected $date=['created_at','updated_at'];
}
