@extends('layouts.app')
@section('title', 'Nạp Tiền')
@section('payment-body')
<div class="payment-body main_df_bt">
    <div id="loading-icon" style="display: none;">
        <img src="{{ asset('libs/baokim/images/loading.gif') }}">
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#card">Thẻ điện thoại</a></li>
                            <li class=""><a data-toggle="tab" href="#momo">Momo</a></li>
                            <li class=""><a data-toggle="tab" href="#nganluong">Ngân Hàng, Visa, Master Card</a></li>
                            <li class=""><a data-toggle="tab" href="#sms">Nạp tin nhắn</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="card" class="tab-pane fade in active">
                                <form action="{{ route('recharge.store') }}" method="POST" autocomplete="off" id="card-form">
                                    @csrf
                                    <input type="hidden" name="type" class="type" value="card">
                                    <div class="list_amount">
                                        <div class="tab_amount">
                                            <div id="list_amount">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="10" class="card-choose__amount text-center boder_active">10K</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="20" class="card-choose__amount text-center">20K</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="30" class="card-choose__amount text-center">30K</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="50" class="card-choose__amount text-center">50K</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="100" class="card-choose__amount text-center">100K</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="200" class="card-choose__amount text-center">200K</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="300" class="card-choose__amount text-center">300K</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <div for="500" class="card-choose__amount text-center">500K</div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="money" value="50K">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <select name="sim_id" id="sim" class="form-control">
                                            @foreach($sims as $sim)
                                                @if(!$sim['maintenance'])
                                                    <option value="{{ $sim['id'] }}">{{ $sim['name'] . ' - ' . $sim['discount']}}</option>
                                                @else
                                                    <option value="0">Nạp thẻ cào đang bảo trì!!!</option>
                                                    
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <input type="text" class="form-control" name="serial" placeholder="Số serial number" value="{{ old('serial') }}">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" type="text" class="form-control" name="code" placeholder="Mã nạp" value="{{ old('code') }}">
                                        <div class="clearfix"></div>
                                    </div>
                                </form>

                                <div class="col-xs-12">
                                    <h4><b>Lưu ý:</b> Mệnh giá bạn chọn ko đúng với mệnh giá thẻ, hệ thống sẽ <b>NUỐT THẺ</b> và ko hoàn trả lại, hãy cẩn thận</h4>
                                </div>
                            </div>

                            <div id="momo" class="tab-pane fade">
                                <p>Chuyển tiền vào tài khoản momo dưới đây và điền thông tin bên dưới!</p>
                                <img src="{{ asset('images/momo.png') }}" alt="momo payment" class="img img-responsive img-rounded">
                                <form action="{{ route('recharge.store') }}" method="POST" autocomplete="off" id="momo-form" novalidate="novalidate">
                                    @csrf
                                    <input type="hidden" name="type" class="type" value="momo">
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" class="valid" type="text" name="phone" aria-invalid="false">
                                        <label for="" alt="Số điện thoại người gửi" placeholder="Số điện thoại người gửi"></label>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" class="valid" type="text" value="" name="code_momo" aria-invalid="false">
                                        <label for="" alt="Mã giao dịch MoMo" placeholder="Mã giao dịch MoMo"></label>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" class="" type="text" name="money">
                                        <label for="" alt="Số tiền nạp" placeholder="Số tiền nạp"></label>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>

                            <div id="nganluong" class="tab-pane fade">
                                <form action="{{ route('recharge.order') }}" method="post" autocomplete="off" id="nganluong-form">
                                    @csrf
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" class="form-control valid" type="text" required name="total_amount" aria-invalid="false" placeholder="Số tiền nạp">
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" class="form-control valid" type="text" required name="buyer_fullname" aria-invalid="false" placeholder="Họ Tên">
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" class="form-control valid" type="text" required name="buyer_email" aria-invalid="false" placeholder="Email">
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-xs-12 input-block">
                                        <input autocomplete="off" class="form-control valid" type="text" required name="buyer_mobile" aria-invalid="false" placeholder="Số điện thoại">
                                        
                                        <div class="clearfix"></div>
                                    </div>

                                    <ul class="list-content">
                                        <li class="active">
                                            <label><input type="radio" value="ATM_ONLINE" name="option_payment" checked>Thanh toán online bằng thẻ ngân hàng nội địa</label>
                                            <div class="boxContent">
                                                <p><i><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.</i></p>
                                                <ul class="cardList clearfix">
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                            <input type="radio" value="BIDV" name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods">
                                                        <label for="vcb_ck_on">
                                                            <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                            <input type="radio" value="VCB" name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vnbc_ck_on">
                                                            <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                            <input type="radio" value="DAB"  name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="tcb_ck_on">
                                                            <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                            <input type="radio" value="TCB"  name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_mb_ck_on">
                                                            <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                            <input type="radio" value="MB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vib_ck_on">
                                                            <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                                            <input type="radio" value="VIB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vtb_ck_on">
                                                            <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                            <input type="radio" value="ICB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_exb_ck_on">
                                                            <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
                                                            <input type="radio" value="EXB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_acb_ck_on">
                                                            <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                            <input type="radio" value="ACB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_hdb_ck_on">
                                                            <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
                                                            <input type="radio" value="HDB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_msb_ck_on">
                                                            <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                            <input type="radio" value="MSB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_nvb_ck_on">
                                                            <i class="NVB" title="Ngân hàng Nam Việt"></i>
                                                            <input type="radio" value="NVB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vab_ck_on">
                                                            <i class="VAB" title="Ngân hàng Việt Á"></i>
                                                            <input type="radio" value="VAB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vpb_ck_on">
                                                            <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
                                                            <input type="radio" value="VPB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_scb_ck_on">
                                                            <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                            <input type="radio" value="SCB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_pgb_ck_on">
                                                            <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                            <input type="radio" value="PGB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_gpb_ck_on">
                                                            <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
                                                            <input type="radio" value="GPB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_agb_ck_on">
                                                            <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                            <input type="radio" value="AGB"  name="bankcode" >
                                                        
                                                    </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_sgb_ck_on">
                                                            <i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
                                                            <input type="radio" value="SGB"  name="bankcode" >
                                                        
                                                    </label></li>   
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="BAB" title="Ngân hàng Bắc Á"></i>
                                                            <input type="radio" value="BAB"  name="bankcode" >
                                                        
                                                    </label></li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="TPB" title="Tền phong bank"></i>
                                                            <input type="radio" value="TPB"  name="bankcode" >
                                                        
                                                    </label></li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="NAB" title="Ngân hàng Nam Á"></i>
                                                            <input type="radio" value="NAB"  name="bankcode" >
                                                        
                                                    </label></li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                                            <input type="radio" value="SHB"  name="bankcode" >
                                                        
                                                    </label></li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
                                                            <input type="radio" value="OJB"  name="bankcode" >
                                                        
                                                    </label></li>                        
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <label><input type="radio" value="IB_ONLINE" name="option_payment">Thanh toán bằng IB</label>
                                            <div class="boxContent">
                                                <p><i><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.</i></p>

                                                <ul class="cardList clearfix">
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                            <input type="radio" value="BIDV"  name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                            <input type="radio" value="VCB"  name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vnbc_ck_on">
                                                            <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                            <input type="radio" value="DAB"  name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="tcb_ck_on">
                                                            <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                            <input type="radio" value="TCB"  name="bankcode">
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <label><input type="radio" value="ATM_OFFLINE" name="option_payment">Thanh toán atm offline</label>
                                            <div class="boxContent">
                                                <ul class="cardList clearfix">
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                            <input type="radio" value="BIDV"  name="bankcode">
                                                        </label>
                                                    </li>
                                                        
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                            <input type="radio" value="VCB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="vnbc_ck_on">
                                                            <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                            <input type="radio" value="DAB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="tcb_ck_on">
                                                            <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                            <input type="radio" value="TCB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_mb_ck_on">
                                                            <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                            <input type="radio" value="MB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vtb_ck_on">
                                                            <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                            <input type="radio" value="ICB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_acb_ck_on">
                                                            <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                            <input type="radio" value="ACB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_msb_ck_on">
                                                            <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                            <input type="radio" value="MSB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_scb_ck_on">
                                                            <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                            <input type="radio" value="SCB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_pgb_ck_on">
                                                            <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                            <input type="radio" value="PGB"  name="bankcode">
                                                        </label>
                                                    </li>
                                                    
                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_agb_ck_on">
                                                            <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                            <input type="radio" value="AGB"  name="bankcode">
                                                        </label>
                                                    </li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                                            <input type="radio" value="SHB"  name="bankcode">
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <label><input type="radio" value="NH_OFFLINE" name="option_payment">Thanh toán tại văn phòng ngân hàng</label>
                                            <div class="boxContent">
                                                <ul class="cardList clearfix">
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                            <input type="radio" value="BIDV"  name="bankcode" >

                                                        </label></li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                            <input type="radio" value="VCB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="vnbc_ck_on">
                                                            <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                            <input type="radio" value="DAB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="tcb_ck_on">
                                                            <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                            <input type="radio" value="TCB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_mb_ck_on">
                                                            <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                            <input type="radio" value="MB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vib_ck_on">
                                                            <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                                            <input type="radio" value="VIB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vtb_ck_on">
                                                            <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                            <input type="radio" value="ICB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_acb_ck_on">
                                                            <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                            <input type="radio" value="ACB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_msb_ck_on">
                                                            <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                            <input type="radio" value="MSB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_scb_ck_on">
                                                            <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                            <input type="radio" value="SCB"  name="bankcode" >

                                                        </label></li>



                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_pgb_ck_on">
                                                            <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                            <input type="radio" value="PGB"  name="bankcode" >

                                                        </label></li>

                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_agb_ck_on">
                                                            <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                            <input type="radio" value="AGB"  name="bankcode" >

                                                        </label></li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="TPB" title="Tền phong bank"></i>
                                                            <input type="radio" value="TPB"  name="bankcode" >

                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <label><input type="radio" value="VISA" name="option_payment" selected="true">Thanh toán bằng thẻ Visa hoặc MasterCard</label>
                                            <div class="boxContent">
                                                <p><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>:Visa hoặc MasterCard.</p>
                                                <ul class="cardList clearfix">
                                                    <li class="bank-online-methods">
                                                        <label for="vcb_ck_on">Visa:<input type="radio" value="VISA" name="bankcode"></label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vnbc_ck_on">Master:<input type="radio" value="MASTER" name="bankcode"></label>
                                                    </li>
                                                </ul>   
                                            </div>
                                        </li>
                                        <li>
                                            <label><input type="radio" value="CREDIT_CARD_PREPAID" name="option_payment" selected="true">Thanh toán bằng thẻ Visa hoặc MasterCard trả trước</label>
                                        </li>
                                    </ul>
                                </form>
                            </div>

                            <div id="sms" class="tab-pane fade">
                                <br />
                                <p>Soạn tin nhắn: ON DZ {{ Auth::id() }}</p>
                                <p>Gửi 8785 (+4.000 VNĐ)</p>
                                <p>Gửi 8685 (+2.500 VNĐ)</p>
                                <p>Gửi 8585 (+1.200 VNĐ)</p>
                            </div>

                            <div class="col-xs-12 input-block" id="recharge">
                                <button type="button" class="btn btn-green recharge-btn">Nạp tiền</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/baokim/css/create.css') }}">
    <style>
        .list-content li {
            list-style: none outside none;
            margin: 0 0 10px;
        }
        
        .list-content li .boxContent {
            display: none;
            width: 636px;
            border: 1px solid #cccccc;
            padding: 10px;
        }
        .list-content li.active .boxContent {
            display: block;
        }
        .list-content li .boxContent ul {
            height:280px;
        }
        
        i.VISA, i.MASTE, i.AMREX, i.JCB, i.VCB, i.TCB, i.MB, i.VIB, i.ICB, i.EXB, i.ACB, i.HDB, i.MSB, i.NVB, i.DAB, i.SHB, i.OJB, i.SEA, i.TPB, i.PGB, i.BIDV, i.AGB, i.SCB, i.VPB, i.VAB, i.GPB, i.SGB,i.NAB,i.BAB 
        { width:80px; height:30px; display:block; background:url(https://www.nganluong.vn/webskins/skins/nganluong/checkout/version3/images/bank_logo.png) no-repeat;}
        i.MASTE { background-position:0px -31px}
        i.AMREX { background-position:0px -62px}
        i.JCB { background-position:0px -93px;}
        i.VCB { background-position:0px -124px;}
        i.TCB { background-position:0px -155px;}
        i.MB { background-position:0px -186px;}
        i.VIB { background-position:0px -217px;}
        i.ICB { background-position:0px -248px;}
        i.EXB { background-position:0px -279px;}
        i.ACB { background-position:0px -310px;}
        i.HDB { background-position:0px -341px;}
        i.MSB { background-position:0px -372px;}
        i.NVB { background-position:0px -403px;}
        i.DAB { background-position:0px -434px;}
        i.SHB { background-position:0px -465px;}
        i.OJB { background-position:0px -496px;}
        i.SEA { background-position:0px -527px;}
        i.TPB { background-position:0px -558px;}
        i.PGB { background-position:0px -589px;}
        i.BIDV { background-position:0px -620px;}
        i.AGB { background-position:0px -651px;}
        i.SCB { background-position:0px -682px;}
        i.VPB { background-position:0px -713px;}
        i.VAB { background-position:0px -744px;}
        i.GPB { background-position:0px -775px;}
        i.SGB { background-position:0px -806px;}
        i.NAB { background-position:0px -837px;}
        i.BAB { background-position:0px -868px;}
        
        ul.cardList li {
            cursor: pointer;
            float: left;
            margin-right: 0;
            padding: 5px 4px;
            text-align: center;
            width: 90px;
        }
    </style>
@endpush
@push('script')
    <script type="text/javascript" src="{{ asset('libs/baokim/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/baokim/js/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/baokim/js/create.js') }}"></script>
    <script>
        @if(session('success') || session('error'))
            alert('{{ session('success') ?? session('error') }}');
        @endif
        @if(session('checkout_url'))
            location.href = '{{ session('checkout_url') }}';
        @endif

        $(document).ready(function() {
            $('input[name="option_payment"]').bind('click', function() {
                $('.list-content li').removeClass('active');
                $(this).parent().parent('li').addClass('active');
            });

            $('.recharge-btn').on('click', function() {
                let form = $('.tab-pane.in.active').find('form');
                let type = form.find('input[name="type"]').val();
                
                if (form.valid()) {
                    $('#loading-icon').show();
                    form.submit();
                } else {
                    $('#loading-icon').hide();
                }
            });
        });
    </script>
@endpush