<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
      protected $fillable=['_token','_method','visas1','visas2','visas3','visas4','passer','naissance'	,'mariage','deces','carte1','carte2','consule','avatar','byUser','authorisation','procuration','legalisations'];
    protected $date=['created_at','updated_at'];
}
