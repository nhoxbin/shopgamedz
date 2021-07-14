<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoxEvent extends Model
{
    protected $fillable = ['name', 'image', 'box_total', 'amount', 'chars', 'box_id', 'prize', 'giftcode', 'hdsd'];

    public function boxes() {
        return $this->hasMany(Box::class);
    }

    public function getIsEventEndAttribute() {
        return !($this->boxes()->where('user_id', null)->count() > 0);
    }

    public function boxes_remain() {
        return $this->boxes()->where('user_id', '!=', null)->count();
    }
}
