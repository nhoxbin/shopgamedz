@extends('layouts.app')

@section('payment-body')
<div class="payment-body main_df_bt">
    <div class="banner">
        <img src="{{ asset('libs/baokim/images/banner_03.png') }}">
        <div class="conten_banner">
            Nạp Game Mobile Giá Rẻ,<br>
            Nhanh Chóng Với<br>
            Shop Game DZ
        </div>
    </div>
    <div class="reg_lg">
        <a class="col-md-6 col-sm-6 col-xs-6 btn_reg" href="{{ route('register') }}">
            <div class="row">
                Đăng ký
            </div>
        </a>
        <a class="col-md-6 col-sm-6 col-xs-6 btn_login" href="{{ route('login') }}">
            <div class="row">
                Đăng nhập
            </div>
        </a>
    </div>
    <div class="clearfix"></div>
    <div class="conten_home">
        <h3 class="text-center">ĐA DẠNG TIỆN ÍCH</h3>
        <div class="conten_df">
            Nạp tiền trực tiếp vào tài khoản game, nạp vàng gold cash tất cả các game trên thế giới, giá rẻ nhanh chóng uy tín, thanh toán bằng thẻ cào điện thoại
        </div>
    </div>
    <div class="list_item pdtop20">
        <div class="panel">
            <a href="#">
                <div class="panel-footer">
                    <div class="icon_left pull-left">
                        <img class="width100" src="{{ asset('libs/baokim/images/visa.png') }}">
                    </div>
                    <div class="pull-left conten_ft_home">Nạp Tiền từ thẻ visa</div>
                    <div class="clearfix"></div>
                </div>
            </a>
            <div class="panel-body">
                <div class="icon_left pull-left">
                    <img class="width100" src="{{ asset('https://i.imgur.com/obHhDFv.png') }}">
                </div>
                <div class="pull-left conten_ft_home">Nạp tiền bằng thẻ cào điện thoại</div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-footer">
                <div class="icon_left pull-left">
                    <img class="width100" src="{{ asset('https://i.imgur.com/qLoT1hr.png') }}">
                </div>
                <div class="pull-left conten_ft_home">Nạp tiền từ Ngân Hàng</div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="icon_left pull-left">
                    <img class="width100" src="{{ asset('libs/baokim/images/invoice.svg') }}">
                </div>
                <div class="pull-left conten_ft_home">Tạo đơn hàng Nạp Game</div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('libs/baokim/css/home.css') }}">
@endpush