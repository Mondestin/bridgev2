<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventes extends Model
{
    protected $fillable=['montant','types','dem_no','status','byUser'];
    protected $date=['created_at','updated_at'];
}
