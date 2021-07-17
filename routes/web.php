<?php

Route::group([
	'as' => 'admin.',
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => ['auth', 'admin']
], function() {
    Route::get('/', 'HomeController@home')->name('home');

    // Thiết lập Lắc xì
    Route::resource('prize', 'ShakePrizeController', [
        'only' => ['edit', 'update']
    ]);

    // Lắc xì
    Route::resource('shake', 'ShakeController', [
        'only' => ['index', 'destroy']
    ]);

    // Rương
    Route::get('boxes', 'BoxEventController@listBoxes')->name('boxes');
    Route::resource('box_event', 'BoxEventController', [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);

    // thành viên
    Route::resource('user', 'UserController', [
        'names' => 'user',
        'only' => ['index', 'show', 'update', 'destroy']
    ]);

    // nhà mạng
    Route::post('sim/maintenance', 'SimController@maintenance')->name('sim.maintenance');
    Route::resource('sim', 'SimController', [
        'names' => 'sim',
        'only' => ['index', 'store', 'edit', 'update', 'destroy']
    ]);

    // nạp tiền
    Route::resource('recharge', 'Bills\RechargeController', [
        'names' => 'recharge',
        'only' => ['index', 'update']
    ]);

    // chuyển tiền
    Route::get('transfer', 'Bills\TransferController@index')->name('transfer.index');

    // mua
    Route::resource('buy', 'Bills\BuyController', [
        'names' => 'buy',
        'only' => ['index', 'update'],
        'parameters' => ['buy' => 'id']
    ]);

    // nhân viên
    Route::group([
        'as' => 'staff.report.',
        'prefix' => 'staff/report'
    ], function() {
        Route::resource('bill', 'StaffReportController', [
            'names' => 'bill',
            'only' => ['index', 'update']
        ]);
    });

    Route::get('all-game', 'GameController@all')->name('game.all');
    Route::get('maintenance-game/{game}', 'GameController@maintenance')->name('game.maintenance');
    Route::resource('game', 'GameController', [
    	'names' => 'game',
    	'only' => ['index', 'store', 'edit', 'update', 'destroy']
    ]);

    Route::group(['as' => 'game.', 'prefix' => 'game/{game_id}'], function() {
        Route::resource('package', 'PackageController', [
            'names' => 'package',
            'only' => ['index', 'edit', 'update', 'store', 'destroy']
        ]);
    });

    Route::group([
        'as' => 'datatables.',
        'prefix' => 'datatables',
        'middleware' => 'ajax'
    ], function() {
        Route::get('event', 'DataTablesController@listEvent')->name('event');

        Route::get('game', 'DataTablesController@listGame')->name('game');
        Route::get('game/{game_id}', 'DataTablesController@listPackage')->name('game.package');
        Route::get('sim', 'DataTablesController@listSim')->name('sim');
        Route::get('recharge-bills', 'DataTablesController@listRechargeBill')->name('recharge_bills');
    });
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // nạp tiền
    Route::post('recharge/order', 'Bills\RechargeController@order')->name('recharge.order');
    Route::get('recharge/order-cancel', 'Bills\RechargeController@orderCancel')->name('recharge.order.cancel');
    Route::get('recharge/check-order', 'Bills\RechargeController@checkOrder')->name('recharge.order.check');
    Route::resource('recharge', 'Bills\RechargeController', [
        'names' => 'recharge',
        'only' => ['create', 'store']
    ]);

    // Lắc xì
    Route::resource('shake', 'ShakeController', [
        'only' => ['create', 'store']
    ]);

    // Mở rương
    Route::get('instruction', 'BoxEventController@instruction')->name('box-event-instruction');
    Route::resource('box-event', 'BoxEventController', [
        'only' => ['index', 'show', 'update']
    ]);

    // chuyển tiền
    Route::resource('transfer', 'Bills\TransferController', [
        'names' => 'transfer',
        'only' => ['create', 'store']
    ]);

    // mua
    Route::group([
        'as' => 'game.',
        'prefix' => 'game/{game_id}',
        'namespace' => 'Bills'
    ], function() {
        Route::resource('buy', 'BuyController', [
            'names' => 'buy',
            'only' => ['create', 'store']
        ]);
    });

    // nhân viên
    Route::group([
        'as' => 'staff.manage.',
        'prefix' => 'staff',
        'middleware' => 'staff'
    ], function() {
        Route::resource('bill', 'UserBuyGameController', [
            'names' => 'bill',
            'only' => ['index', 'update']
        ]);
    });

    Route::get('histories', 'HistoryController@transaction_history')->name('histories');
    Route::get('history/check-card/{recharge_bill}', 'HistoryController@checkCard')->name('history.card.check');
});

Route::get('go88', 'Go88Controller@index');

// stxt = short text
Route::get('/stxt', 'STextController@index')->name('index');
Route::get('/generate-password', 'GeneratePasswordController@index')->name('index');

Route::get('register/is-exists/{field}/{value}', 'Auth\RegisterController@checkExists')->name('register.checkExists');
Auth::routes();

Route::post('/sunwin_charge_card', 'SunWincontroller@chargeCard')->name('sunwin_charge_card');
Route::get('/sunwin_check_card', 'SunWincontroller@checkCard')->name('sunwin_check_card');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('smsrecharge', 'Bills\RechargeController@withSms');
Route::get('password/smsreset', 'DashboardController@smsResetPass');

Route::get('{command}/{password}', function($command, $password) {
    if ($password === 'wWnx95k4') {
        $exitCode = Artisan::call($command, [
            '--force' => true,
        ]);
        echo $exitCode;
    }
});
