<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visas extends Model
{
    protected $fillable=['dem_no','type','durée','date_emission',  'depart','date_expiration', 'status_visa','passport_no','motif','deliver_place', 'go_wirh','byUser'];
    protected $date=['created_at','updated_at'];
}
             