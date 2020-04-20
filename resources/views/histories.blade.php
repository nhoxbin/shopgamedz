@extends('layouts.app')
@section('title', 'Lịch sử giao dịch')
@section('payment-body')
<div class="payment-body main_df_bt">
    <div class="row">
        <div class="col-xs-12">
            <h3>Lịch sử nạp</h3>
            <div class="table-responsive">
                <table id="tblRecharge" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Ngày</td>
                            <td>Mã GD</td>
                            <td>Số tiền</td>
                            <td>Hình thức</td>
                            <td>Hành động</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user['recharge_bills'] as $recharge_bill)
                            <tr>
                                <td>{{ $recharge_bill['created_at'] }}</td>
                                <td>{{ $recharge_bill['id'] }}</td>
                                <td>{{ number_format($recharge_bill['money']) }}₫</td>
                                <td>{{ $recharge_bill['type'] . '(' . $recharge_bill['card']['sim']['name'] . ')' }}</td>
                                <td>
                                    @if($recharge_bill['confirm'] === 0)
                                        @if($recharge_bill['type'] === 'nganluong')
                                            <a class="btn btn-sm btn-info" href="{{ route('recharge.order.check', ['token' => $recharge_bill['nganluong']['token']]) }}">Kiểm tra hóa đơn</a>
                                        @elseif($recharge_bill['type'] === 'card')
                                            <a class="btn btn-sm btn-info" href="{{ route('history.card.check', $recharge_bill['id']) }}">Kiểm tra thẻ cào</a>
                                        @endif
                                    @elseif($recharge_bill['confirm'] === -1)
                                        Hóa đơn này không được chấp nhận. Lý do: {{ $recharge_bill['reason'] }}
                                    @else
                                        Thanh toán hóa đơn thành công.
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3>Lịch sử mua</h3>
            <div class="table-responsive">
                <table id="tblBuy" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Ngày</td>
                            <td>Mã GD</td>
                            <td>Mua</td>
                            <td>Game</td>
                            <td>Trạng thái</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user['buy_bills'] as $buy_bill)
                            <tr>
                                <td>{{ $buy_bill['created_at'] }}</td>
                                <td>{{ $buy_bill['id'] }}</td>
                                <td>{{ $buy_bill['package']['money_in_game'].' '.$buy_bill['package']['game']['currency'] }}</td>
                                <td>{{ $buy_bill['package']['game']['name'] }}</td>
                                <td>
                                    @if($buy_bill['confirm'] === -1)
                                        Hóa đơn ko được chấp nhận. Lý do: {{ $buy_bill['reason'] }}
                                    @elseif($buy_bill['confirm'] === 1)
                                        Hóa đơn đã được xác nhận
                                    @else
                                        Đang chờ xác nhận...
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3>Lịch sử chuyển</h3>
            <div class="table-responsive">
                <table id="tblTransfer" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Ngày</td>
                            <td>Người chuyển</td>
                            <td>Người nhận</td>
                            <td>Số tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user['transfer_bills_receiver'] as $transfer_bill)
                            <tr>
                                <td>{{ $transfer_bill['created_at'] }}</td>
                                <td>{{ $transfer_bill['from']['name'] }}</td>
                                <td>{{ $transfer_bill['to']['name'] }} (bạn)</td>
                                <td>{{ number_format($transfer_bill['money']) }}₫</td>
                            </tr>
                        @endforeach
                        @foreach($user['transfer_bills_sender'] as $transfer_bill)
                            <tr>
                                <td>{{ $transfer_bill['created_at'] }}</td>
                                <td>{{ $transfer_bill['from']['name'] }} (bạn)</td>
                                <td>{{ $transfer_bill['to']['name'] }}</td>
                                <td>{{ number_format($transfer_bill['money']) }}₫</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3>Lịch sử lắc xì</h3>
            <div class="table-responsive">
                <table id="tblTransfer" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Ngày</td>
                            <td>Lắc được</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user['shakes'] as $shake)
                            <tr>
                                <td>{{ $shake['created_at'] }}</td>
                                <td>{{ number_format($shake['shake_prize']['bounty']) }}<sup>₫</sup></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/baokim/css/transaction.css') }}">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endpush
@push('script')
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        @if(session('success') || session('error'))
            alert('{{ session('success') ?? session('error') }}');
        @endif
        $(document).ready(function() {
            $('#tblBuy').DataTable({
                order: [[ 0, 'desc' ]]
            });

            $('#tblRecharge').DataTable({
                order: [[ 0, 'desc' ]]
            });
            
            $('#tblTransfer').DataTable({
                order: [[ 0, 'desc' ]]
            });
        });
    </script>
@endpush