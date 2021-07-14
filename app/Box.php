<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    public function box_event() {
        return $this->belongsTo(BoxEvent::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
