@extends('layouts.app')
@section('title', 'Sự kiện')
@section('payment-body')
<div class="payment-body main_df_bt">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#event-start">Sự kiện đang mở</a></li>
                            <li class=""><a data-toggle="tab" href="#event-end">Sự kiện kết thúc</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="event-start" class="tab-pane fade in active">
                                @foreach ($events as $event)
                                    <div class="other-function-container">
                                        <a href="{{ route('box-event.show', $event->id) }}">
                                            <div class="other-function-content shadow">
                                                <img src="/uploads/{{ $event->image }}" style="width: 120px">
                                                <div class="content-text">
                                                    <span><b>{{ $event->name }}</b></span><br>
                                                    <span><b>Còn</b>: <span style="color: red;">{{ $event->boxes_remain() }}</span>/{{ $event->boxes->count() }} Rương</span><br>
                                                    <span><b>Phần thưởng:</b> {{ $event->prize }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div id="event-end" class="tab-pane fade">
                                @foreach ($events_end as $event)
                                    <div class="other-function-container">
                                        <a href="{{ route('box-event.show', $event->id) }}">
                                            <div class="other-function-content shadow">
                                                <img src="/uploads/{{ $event->image }}" style="width: 120px">
                                                <div class="content-text">
                                                    <span>{{ $event->name }}</span><br>
                                                    <span>Phần thưởng: {{ $event->prize }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
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
<link rel="stylesheet" type="text/css" href="{{ asset('libs/baokim/css/dashboard.css') }}">
@endpush
@push('script')
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
            unbox(e, box_id) {
                var imgBox = $(e.target.parentNode.parentNode).find('.imgBox');
                $.post(route('unbox'), {box_id: box_id}).then(resp => {
                    if (resp === 'true') {
                        alert(`Bạn đã mua thành công rương #${box_id}! Vui lòng đợi hết tất cả các rương được mua bạn sẽ biết kết quả !`);
                        $(e.target.parentNode).text('Rương đã mở');
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
