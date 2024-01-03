<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GestionCartesConsulaire extends Model
{
   protected $fillable=['id_number' ,'date_emission' ,'date_expiration' ,'type' ,'validity' ,'card_status' ,'print_status','byUser','card_no','qr_link'];
    protected $date=['created_at','updated_at'];
}
