<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = "carrera";
    protected $fillable = ['siglas','nombre','nivel','creacion','baja'];
}
