<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sim extends Model
{
    protected $fillable = ['name', 'discount', 'maintenance'];

    public function cards() {
    	return $this->hasMany('App\Card');
    }
}
