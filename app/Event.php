<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     protected $fillable = [
        'titre', 'description', 'event_date', 'event_id','byUser','type','color'];
}
