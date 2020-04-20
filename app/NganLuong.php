<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NganLuong extends Model
{
	public $incrementing = false;
	protected $primaryKey = 'recharge_bill_id';
	protected $keyType = 'string';
    protected $fillable = ['recharge_bill_id', 'token'];

    public function recharge_bill() {
    	return $this->belongsTo('App\RechargeBill');
    }
}
