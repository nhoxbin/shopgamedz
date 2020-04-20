<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class SunWincontroller extends Controller
{
	protected $info;

	public function __construct() {
		$this->info = [
    		'command' => "loginHash",
			'username' => 'tkiemkhach',
			'password' => 'tkiemkhach',
			'platformId' => 4,
			'deviceId' => '54f75eec-1d70-43a2-1e1a-fa5ffae5d0db',
			'hash' => 'fbdcfa77340d5d81be9bfe0ed68e7eba'
    	];
	}

    public function chargeCard(Request $request) {
    	if ($request->password !== 'VAv76iu99q') {
    		return response('Sai mật khẩu chương trình!');
    	}
    	$telcoId = ['Viettel' => 1, 'Vinaphone' => 2, 'Mobiphone' => 3];
    	if (in_array($request->telcoId, $telcoId)) {
	    	$curl = json_decode(Curl::to('https://api.2ahvqkxsuzrrlvqigar8.com/id')->withData($this->info)->post(), true);

	        if ($curl['status'] == 0) {
	            $accessToken = $curl['data']['accessToken'];

	            $url = "https://api.2ahvqkxsuzrrlvqigar8.com/paygate?command=chargeCard&serial={$request->serial}&code={$request->code}&telcoId={$request->telcoId}&amount={$request->amount}";
	            $curl = json_decode(Curl::to($url)->withHeader('authorization: ' . $accessToken)->get(), true);

	            if ($curl['status'] == 1099) {
	                // 1099: thẻ sử dụng sucess, 1: serial, code sai
	                // Thẻ đang được xử lý
	                return response(['success' => true, 'message' => 'Thẻ sẽ được xử lý trong 5 phút, vui lòng vào game chơi và chờ +KNB ! Nếu quá 5 phút chưa thấy có KNB hãy liên hệ Admin!']);
	            }
	        }
            // ko đăng nhập được
            return response(['success' => false, 'message' => $curl['data']['message']]);
	    }
    }

    public function checkCard(Request $request) {
    	if ($request->password !== 'VAv76iu99q') {
    		return response('Sai mật khẩu chương trình!');
    	}

    	$telcoId = ['Viettel' => 1, 'Vinaphone' => 2, 'Mobiphone' => 3];
        $curl = json_decode(Curl::to('https://api.2ahvqkxsuzrrlvqigar8.com/id')
            ->withData($this->info)->post(), true);

        if ($curl['status'] == 0) {
            $accessToken = $curl['data']['accessToken'];

            $url = "https://api.2ahvqkxsuzrrlvqigar8.com/paygate?command=fetchCardHistory&limit=1500&skip=0";
            $curl = json_decode(Curl::to($url)->withHeader('authorization: ' . $accessToken)->get(), true);

            $serial = $request->serial;
            $card = array_filter($curl['data']['items'], function($card) use ($serial) {
                return $card['serial'] == $serial;
            });
            if (!empty($card)) {
                $card = reset($card);
                return response($card);
            }
        }
    }
}
