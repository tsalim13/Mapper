<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Louer extends Model
{
    protected $table = 'louers';
    public $timestamps = false;

    protected $fillable = ['client_id','marker_id','fromDate','toDate'];
}
