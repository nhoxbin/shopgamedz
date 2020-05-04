<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\Package;
use App\Sim;
use App\RechargeBill;

class DataTablesController extends Controller
{
    public function listGame(Request $request) {
    	$games = Game::select(['id', 'picture', 'name', 'type', 'currency', 'sort_currency', 'maintenance'])->get();
    	$rt_dt = [];
    	for ($i = 0; $i < count($games); $i++) {
    		$rt_dt[$i]['picture'] = '<img src="'.url($games[$i]['picture']).'" width="100" height="100">';
    		$rt_dt[$i]['name'] = $games[$i]['name'];
    		$rt_dt[$i]['type'] = $games[$i]['type'] === 0 ? 'ID' : 'Tài khoản';
    		$rt_dt[$i]['currency'] = $games[$i]['currency'];
            $rt_dt[$i]['sort_currency'] = $games[$i]['sort_currency'];
    		$rt_dt[$i]['actions'] = '<div class="btn-group" role="group" aria-label="action button">
								<button type="button" class="btn btn-warning" onclick="javascript:location.href = \''. route('admin.game.maintenance', $games[$i]['id']) . '\'">' . ($games[$i]['maintenance'] === 0 ? 'Bảo trì' : 'Ngưng bảo trì') . '</button>
                                <button type="button" class="btn btn-secondary" onclick="javascript:location.href = \''. route('admin.game.package.index', $games[$i]['id']) . '\'">Gói</button>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalGame" onclick="app.editGame('.$games[$i]['id'].')">Sửa</button>
								<button type="button" class="btn btn-danger" onclick="app.deleteGame('.$games[$i]['id'].')">Xóa</button>
							</div>';
    	}
    	return response($rt_dt, 200);
    }

    public function listPackage(Request $request) {
        $packages = Game::find($request->game_id)->packages;
        $rt_dt = [];
        for ($i = 0; $i < count($packages); $i++) {
            $rt_dt[$i]['money'] = number_format($packages[$i]['money']) . ' ₫';
            $rt_dt[$i]['money_in_game'] = number_format($packages[$i]['money_in_game']);
            $rt_dt[$i]['actions'] = '<div class="btn-group btn-group-sm" role="group" aria-label="action button">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#packageModal" onclick="app.editPackage('.$packages[$i]['id'].')">Sửa</button>
                                    <button type="button" class="btn btn-danger" onclick="app.deletePackage('.$packages[$i]['id'].')">Xóa</button>
                                    </div>';
        }
        return response($rt_dt, 200);
    }

    public function listSim(Request $request) {
        $sim = Sim::all();
        $rt_dt = [];
        for ($i = 0; $i < count($sim); $i++) {
            $rt_dt[$i]['name'] = $sim[$i]['name'];
            $rt_dt[$i]['discount'] = $sim[$i]['discount'];
            $rt_dt[$i]['maintenance'] = $sim[$i]['maintenance'] ? 'Có' : 'Không';
            $rt_dt[$i]['actions'] = '<div class="btn-group btn-group-sm" role="group" aria-label="action button">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#simModal" onclick="app.editSim('.$sim[$i]['id'].')">Sửa</button>
                                    <button type="button" class="btn btn-danger" onclick="app.deleteSim('.$sim[$i]['id'].')">Xóa</button>
                                    </div>';
        }
        return response($rt_dt, 200);
    }

    public function listRechargeBill() {
        $recharge_bills = RechargeBill::with(['user', 'momo', 'nganluong', 'card' => function($q) {
            $q->with('sim');
        }])->get()->toArray();

        $rt_dt = [];
        for ($i = 0; $i < count($recharge_bills); $i++) {
            $rt_dt[$i]['created_at'] = $recharge_bills[$i]['created_at'];
            $rt_dt[$i]['id'] = $recharge_bills[$i]['id'];
            $rt_dt[$i]['customer_name'] = $recharge_bills[$i]['user']['name'];
            $rt_dt[$i]['money'] = number_format($recharge_bills[$i]['money']) . '₫';
            $rt_dt[$i]['payment_method'] = $recharge_bills[$i]['type'];
            if ($rt_dt[$i]['payment_method'] === 'card') {
                $rt_dt[$i]['card']['sim'] = $recharge_bills[$i]['card']['sim']['name'];
                $rt_dt[$i]['card']['serial'] = $recharge_bills[$i]['card']['serial'];
                $rt_dt[$i]['card']['code'] = $recharge_bills[$i]['card']['code'];
            } elseif ($rt_dt[$i]['payment_method'] === 'momo') {
                $rt_dt[$i]['momo']['phone'] = $recharge_bills[$i]['momo']['phone'];
                $rt_dt[$i]['momo']['code'] = $recharge_bills[$i]['momo']['code'];
            } elseif ($rt_dt[$i]['payment_method'] === 'nganluong') {
                $rt_dt[$i]['nganluong']['link'] = '<a href="' . route('recharge.order.check', ['token' => $recharge_bills[$i]['nganluong']['token']]) . '" target="_blank" class="btn btn-sm btn-primary">Kiểm tra hóa đơn</a>';
            }

            if ($recharge_bills[$i]['confirm'] === 0) {
                $rt_dt[$i]['actions'] = '<div class="btn-group btn-group-sm" role="group" aria-label="action button">
                    <button class="btn btn-primary" onclick="app.action(\'confirm\', \''.$rt_dt[$i]['id'].'\')">Xác nhận</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalReason" onclick="app.order_id = \''.$rt_dt[$i]['id'].'\'">Hủy đơn</button>
                </div>';
            } elseif ($recharge_bills[$i]['confirm'] === -1) {
                $rt_dt[$i]['actions'] = 'Hóa đơn bị từ chối.' . (empty($recharge_bills[$i]['reason']) ? null : ' Lý do: ' . $recharge_bills[$i]['reason']);
            } else {
                $rt_dt[$i]['actions'] = 'Hóa đơn đã được duyệt.';
            }
        }
        return response($rt_dt);
    }
}
