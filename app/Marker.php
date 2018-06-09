<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = 'markers';
    public $timestamps = false;

    protected $fillable = ['name','lat','lng','type','etat'];
}
