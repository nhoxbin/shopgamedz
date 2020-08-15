<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneratePasswordController extends Controller
{
	public static function quickRandom($length = 8) {
	    $pool = 'abcdefghijklmnopqrstuvwxyz';

	    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}


    public function index() {
    	$password = 'HungDZ' . $this->quickRandom();
    	return view('generate-password', compact('password'));
    }
}
