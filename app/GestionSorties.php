<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GestionSorties extends Model
{
    protected  $table="sorties";
    protected $fillable=['title','desc' ,'amount' ,'status' ,'comment', 'emit_by','byUser'];
    protected $date=['created_at','updated_at'];
}
