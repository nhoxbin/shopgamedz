@extends('admin.layouts.master')
@section('heading-name', 'Danh sách sự kiện')
@section('content')
<div class="container-fluid">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
			{{-- <h6 class="m-0 font-weight-bold text-primary">Danh sách các game</h6> --}}
			<div class="text-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventModal" @@click="action = 'add'">
					Thêm event
				</button>
			</div>

			<!-- Modal thêm game -->
			<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="action">@{{ actionLabel }} event</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" onsubmit="return false;">
								<div class="form-group">
									<label class="control-label col-sm-12" for="name">Tên event:</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" v-model="boxEventForm.name">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-12" for="image">Hình:</label>
									<div class="col-sm-12">
										<input type="file" v-on:change="updateFile" accept="images/*">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-12" for="box_total">Tổng số hộp:</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" v-model="boxEventForm.box_total">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-12" for="box_id">ID hộp trúng:</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" v-model="boxEventForm.box_id">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-12" for="amount">Giá:</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" v-model="boxEventForm.amount">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-12" for="prize">Phần thưởng:</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" v-model="boxEventForm.prize">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-12" for="giftcode">Giftcode:</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" v-model="boxEventForm.giftcode">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-12" for="hdsd">HDSD:</label>
									<div class="col-sm-12">
										<textarea v-model="boxEventForm.hdsd" class="form-control" rows="10"></textarea>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
							<button type="button" class="btn btn-primary" @@click="actions">Lưu</button>
						</div>
					</div>
				</div>
			</div>
	    </div>
	    <div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Tên event</th>
							<th>Hình</th>
							<th>Tổng hộp</th>
							<th>ID hộp trúng</th>
							<th>Giá</th>
							<th>Phần thưởng</th>
							<th>Giftcode</th>
							<th>HDSD</th>
							<th>Hành động</th>
						</tr>
					</thead>
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
	@if(session('success'))
		alert('{{ session('success') }}');
	@endif

	var app = new Vue({
		el: '#app',
		data: function() {
			return {
				boxEventForm: {
					id: 0,
					name: '',
					image: null,
					box_total: '',
					box_id: '',
					amount: '',
					prize: '',
					giftcode: '',
					hdsd: '',
				},
				action: '',
				dataTable: null
			}
		},
		computed: {
			actionLabel() {
				if (this.action === 'add') {
					return 'Thêm';
				} else {
					return 'Sửa';
				}
			}
		},
		mounted() {
			this.getListGame();
		},
		methods: {
			updateFile(e) {
				this.boxEventForm.image = e.target.files[0];
			},
			getListGame() {
				$.get(route('admin.datatables.event')).then(list_event => {
					this.dataTable = $('#dataTable').DataTable({
						data: list_event,
				        columns: [
				            { data: 'name' },
				            { data: 'image', orderable: false, searchable: false },
				            { data: 'box_total' },
				            { data: 'box_id' },
				            { data: 'amount' },
				            { data: 'prize' },
				            { data: 'giftcode' },
				            { data: 'hdsd' },
				            { data: 'actions', orderable: false, searchable: false }
				        ]
					});
				});
			},
			actions() {
				let formData = new FormData();
				formData.append('name', this.boxEventForm.name);
				formData.append('image', this.boxEventForm.image);
				formData.append('box_total', this.boxEventForm.box_total);
				formData.append('box_id', this.boxEventForm.box_id);
				formData.append('amount', this.boxEventForm.amount);
				formData.append('prize', this.boxEventForm.prize);
				formData.append('giftcode', this.boxEventForm.giftcode);
				formData.append('hdsd', this.boxEventForm.hdsd);

				let url;
				if (this.action === 'add') {
					url = route('admin.box_event.store');
				} else {
					formData.append('_method', 'PATCH');
					url = route('admin.box_event.update', this.boxEventForm.id);
				}
				$.ajax({
					url: url,
					data: formData,
					method: 'post',
					cache: false,
					contentType: false,
					processData: false,
					success: (resp) => {
						if (resp === 'ok') {
							alert('Thêm thành công!');
							location.reload();
						}
					},
					error: function(resp) {
						alert(resp.responseText);
					}
				});
			},
			editEvent(id) {
				this.action = 'edit';
				this.boxEventForm.id = id;

				$.get(route('admin.box_event.edit', id)).then(game => {
					this.boxEventForm.name = game.name;
					this.boxEventForm.box_total = game.box_total;
					this.boxEventForm.box_id = game.box_id;
					this.boxEventForm.amount = game.amount;
					this.boxEventForm.prize = game.prize;
					this.boxEventForm.giftcode = game.giftcode;
					this.boxEventForm.hdsd = game.hdsd;
				});
			},
			deleteEvent(id) {
				let conf = confirm('Bạn có chắc muốn xóa event này chứ? Khi xóa event này bạn sẽ bị mất dữ liệu!!!');
				if (!conf) {
					return;
				}
				$.ajax({
					url: route('admin.box_event.destroy', id),
					data: {
						_method: 'delete'
					},
					method: 'post',
					success: function(resp) {
						if (resp === 'ok') {
							alert('Xóa thành công!');
							location.reload();
						}
					}
				});
			}
		}
	})
</script>
@endpush
