<?php

namespace App\Http\Controllers;

use Curl;
use Illuminate\Http\Request;

class Go88Controller extends Controller
{
    public function index() {
    	$curl = json_decode(
		    		Curl::to('http://auto247.xyz/soketqua/go88/GetData.php')
		    			->withData(['limit' => 0])
		    			->post()
		    	, true);
    	$data = $curl;
    	return view('go88', compact('data'));
    }
}
