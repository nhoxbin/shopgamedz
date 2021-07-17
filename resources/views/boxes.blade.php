@extends('layouts.app')
@section('title', 'Sự kiện ' . $boxEvent->name)
@section('payment-body')
<div class="payment-body main_df_bt">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <p>Kết quả mã hóa MD5:</p>
                        <div style="text-align: center;">
                            <pre>{{ md5('['.$boxEvent->chars . '][KetQua:#' . $boxEvent->box_id . ']') }}</pre>
                            @if ($boxEvent->is_event_end)
                                <p>Kết quả gốc:</p>
                                <pre>{{ '['.$boxEvent->chars . '][KetQua:#' . $boxEvent->box_id . ']' }}</pre>
                            @endif
                        </div>
                        <div>Đây là kết quả rương trúng thưởng đã được mã hóa để thể hiện tính minh bạch!</div>
                        <div>=> <a href="{{ route('box-event-instruction') }}" style="font-weight: bold">Nhấn vào đây để tìm hiểu thêm</a> <=</div>
                        <br>
                        @if ($is_user_win)
                            <div class="text-center">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#prize">Nhận thưởng</button>
                            </div>
                            <!-- Modal -->
                            <div id="prize" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Nhận phần thưởng</h4>
                                        </div>
                                        <div class="modal-body">
                                            Giftcode:
                                            <pre align="center">{{ $boxEvent->giftcode }}</pre>
                                            Hướng dẫn sử dụng:<br>
                                            {{ $boxEvent->hdsd }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        @endif

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#event-start">Rương</a></li>
                            <li class=""><a data-toggle="tab" href="#event-end">Hoạt động</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="event-start" class="tab-pane fade in active">
                                <p>Trong tất cả các rương chỉ có 1 rương trúng thưởng. Vì vậy kết quả sẽ có khi tất cả các rương được mở! Hãy mở nhiều rương để tăng tỉ lệ trúng nhé! Nếu tất cả rương đã mở, hãy refresh lại trang để xem rương nào đã trúng</p>
                                <p>Phí mở rương: <b>{{ number_format($boxEvent->amount) }}<sup>đ</sup></b></p>
                                <div class="boxHadiah">
                                    @foreach ($boxEvent->boxes as $key => $item)
                                        <div class="kotak">
                                            <div class="imgBox">
                                                @if ($boxEvent->is_event_end)
                                                    @if ($item->stt == $boxEvent->box_id)
                                                        <img src="/images/box/prize.gif">
                                                    @else
                                                        <img src="/images/box/ezgif-2-fb8a95d582da.gif">
                                                    @endif
                                                @else
                                                    <img src="/images/box/SsK0gZ4.gif">
                                                @endif
                                                <span class="stt @if(!empty($item->user_id))unboxed @endif">#{{ $key+1 }}</span>
                                            </div>
                                            <span class="desc @if(!empty($item->user_id))unboxed @endif">
                                                @if (empty($item->user_id))
                                                    <button @@click="unbox($event, {{ $item->id }}, {{ $key+1 }})">Nhấn để mở</button>
                                                @else
                                                    Rương đã mở
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                    </div>
                            </div>

                            <div id="event-end" class="tab-pane fade">
                                @forelse ($unbox as $key => $item)
                                    <p>{{ $item->user->name }} Mở Rương #{{ $item->stt }} vào lúc {{ $item->updated_at->format('d/m/Y H:i') }}</p>
                                @empty
                                    Chưa có hoạt động nào
                                @endforelse
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
    <link rel="stylesheet" href="/libs/css/box.css">
@endpush
@push('script')
<!-- Page level plugins -->
<script src="{{ asset('libs/sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	@if(session('success'))
		alert('{{ session('success') }}');
	@endif

	var app = new Vue({
		el: '#app',
		data: function() {
			return {

			}
		},
		computed: {

		},
		mounted() {
			this.getListBoxes();
		},
		methods: {
            unbox(e, box_id, stt) {
                $.post(route('box-event.update', '{{ $boxEvent->id }}'), {box_id: box_id, '_method': 'patch'}).then(resp => {
                    if (resp === 'true') {
                        alert(`Bạn đã mua thành công rương #${stt}! Vui lòng đợi hết tất cả các rương được mua bạn sẽ biết kết quả !`);
                        var n = $(e.target.parentNode);
                        n.text('Rương đã mở');
                        n.addClass('unboxed');
                        n.parent().find('.stt').addClass('unboxed');
                    } else {
                        alert(resp);
                    }
                });
            },
			getListBoxes() {
				/* $.get(route('admin.datatables.boxes')).then(list_game => {
					this.dataTable = $('#dataTable').DataTable({
						data: list_game,
				        columns: [
				            { data: 'picture', orderable: false, searchable: false },
				            { data: 'name' },
				            { data: 'type' },
				            { data: 'currency' },
				            { data: 'sort_currency' },
				            { data: 'actions', orderable: false, searchable: false }
				        ]
					});
				}); */
			}
		}
	})
</script>
@endpush
