@extends('admin.layouts.master')
@section('heading-name', 'Rương đã mở')
@section('content')
<div class="container-fluid">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Danh sách</h6>
	    </div>
	    <div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thành viên</th>
                            <th>Tên sự kiện</th>
                            <th>ID rương</th>
                            <th>Sđt</th>
                            <th>Thời gian</th>
                        </tr>
                    </thead>
					<tbody>
						@foreach ($boxes as $item)
							<tr>
								<td>{{ $item->user->name }}</td>
								<td>{{ !empty($item->box_event) ? $item->box_event->name : null }}</td>
								<td>{{ $item->stt }}</td>
								<td>{{ !empty($item->user->phone) ? $item->user->phone : null }}</td>
								<td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
	    </div>
	</div>
</div>
@endsection
@push('css')
<!-- Custom styles for this page -->
<link href="{{ asset('libs/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('script')
<!-- Page level plugins -->
<script src="{{ asset('libs/sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	var app = new Vue({
		el: '#app',
		data: function() {
			return {
				dataTable: null
			}
		},
		mounted() {
			$('#dataTable').DataTable()
		}
	})
</script>
@endpush
