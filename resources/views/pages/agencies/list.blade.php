@extends('layouts.index')
@section('title', 'Quản lý đại lý')
@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Quản lý đại lý </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Danh sách đại lý </a>                    
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Danh sách đại lý
                    </h3>
					@csrf
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="{{ route('agencies.get.create') }}" class="btn btn-brand btn-icon-sm">
                                <i class="flaticon2-plus"></i> Thêm mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>
			@if(\Session::has('message'))
				<div class="alert alert-solid-success alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
					<div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
					<div class="alert-text">{!! __('label.'.\Session::get('message'))!!}</div>
					<div class="alert-close">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="la la-close"></i></span>
						</button>
					</div>
				</div>
			@endif
			@if (\Session::has('error') || $errors->any())
				<div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
					<div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
		
					<div class="alert-text">
						<ul>
							@if(\Session::has('error'))
								@if(is_array(\Session::get('error')))
									@foreach(\Session::get('error') as $err)
										<li>{{$err['message']}}</li>
									@endforeach
								@else    
									<li>{{__('error.'.\Session::get('error'))}}</li>
								@endif
							@endif
							@if($errors->any())
								{!! implode('', $errors->all('<li>:message</li>')) !!}
							@endif
						</ul>
					</div>
		
					<div class="alert-close">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="la la-close"></i></span>
						</button>
					</div>
				</div>
			@endif
            <div class="kt-portlet__body">

                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-12 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm theo tên đại lý..." id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>

                <!--end: Search Form -->
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt-datatable" id="ajax_data"></div>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>

@endsection
@section('javascript')
<script>
    "use strict";
// Class definition

var KTDatatableRemoteAjaxDemo = function() {
	// Private functions

	// basic demo
	var demo = function() {

		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: '{{ route("agencies.post.getList") }}',
						method: 'post',
                        params: {
                            _token: $("input[name='_token']").val(),
                        },
						// sample custom headers
						// headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
						map: function(raw) {
							// sample data mapping
							var dataSet = raw;
							if (typeof raw.data !== 'undefined') {
								dataSet = raw.data;
							}
							return dataSet;
						},
					},
				},
				pageSize: 10,
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false,
				footer: false,
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
			},

			// columns definition
			columns: [
				{
					field: 'Id',
					title: '#',
					width: 30,
					type: 'number',
					selector: false,
					textAlign: 'center',
				}, {
					field: 'logo',
					title: 'logo',
					width: 120,
					template: function(data, index) {
						return `<img class="img-thumbnail" src="${data.logo ? data.logo : 'https://via.placeholder.com/200x100'}">`
					}
				}, {
					field: 'title',
					title: 'Tiêu đề',
				},  {
					field: 'fullname',
					title: 'Tên đại lý',
				},
				{
					field: 'domain',
					title: 'domain',
				},
				{
					field: 'Actions',
					title: 'Chức năng',
					sortable: false,
					width: 110,
					overflow: 'visible',
					autoHide: false,
					template: function(data) {
						let url = '{{ route('agencies.get.update',10 ) }}';
						url = url.replace('10', data.Id);
						return `
						<a href="${url}" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Chỉnh sửa">
							<i class="flaticon2-paper"></i>
						</a>
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm delete-agency" data-id="${data.Id}" title="Xóa">
							<i class="flaticon2-trash"></i>
						</a>`;
					},
				}],

		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

	};

	return {
		// public functions
		init: function() {
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableRemoteAjaxDemo.init();
	$(".kt-datatable").on('click', '.delete-agency', function() {
		let id = $(this).data("id");
		Swal.fire({
			title: 'Bạn có muốn xóa',
			text: "Sẽ không thể khôi phục",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Delete'
			}).then((result) => {
			if (result.value) {
				$.ajax({
					url: '{{ route("agencies.delete.deleteMe") }}',
					method: 'DELETE',
					data: {
						id: id,
						_token: $("input[name='_token']").val(),
					},
					success: function(data) {
						console.log(data);
						if (data.status == true) {
							Swal.fire(
								'Đã xóa!',
								'Xóa thành công.',
								'success'
							);
							setTimeout(() => {
								location.reload();
							}, 1000);
						} else {
							Swal.fire(
								'Thất bại!',
								'Vui lòng thử lại sau.',
								'error'
							)
						}
					}
				});
				
			}
		})
	})
});

</script>


@endsection