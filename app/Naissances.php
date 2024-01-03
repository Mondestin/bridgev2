<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Naissances extends Model
{
    protected $fillable=['name','surname','sexe','date_of_birth','time','place','f_name','f_surname','f_age','f_profession','f_adress','m_name','m_surname','m_age','m_profession','m_adress','d_name','d_surname','d_age','d_profession','d_adress','declare_date','relation','byUser','status', 'f_nationality','m_nationality'];
    protected $date=['created_at','updated_at'];
}
