<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GestionStocks extends Model
{
    protected  $table="stocks";
    protected $fillable=['category','start' ,'entering' ,'exiting' ,'obs' ,'byUser'];
    protected $date=['created_at','updated_at'];
}
