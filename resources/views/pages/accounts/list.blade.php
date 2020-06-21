@extends('layouts.index')
@section('title', 'Quản lý đại lý')
@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Quản lý tài khoản </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Danh sách tài khoản </a>                    
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
                        Danh sách Tài khoản
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="add-agency.php" class="btn btn-brand btn-icon-sm">
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
                @csrf

                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-12 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm theo đại lý " id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        url: '{{ route("accounts.post.getList") }}',
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
				pageSize: 20,
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
                    textAlign: 'center',
				},  {
					field: 'username',
					title: 'Username',
					
				}, {
					field: 'email',
					title: 'Email',
				}, {
					field: 'phone',
					title: 'Điện thoại',
				}, {
					field: 'agencyname',
                    title: 'Thuộc đại lý',
                    template: function(data) {
                        return `
                        <span style="width: 114px;"><span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">${data.agencyname}</span></span>
                        `
                    }
				}, {
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 110,
					overflow: 'visible',
					autoHide: false,
					template: function() {
                        return `
                       
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Chỉnh sửa">
							<i class="flaticon2-paper"></i>
						</a>
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Xóa">
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
});

</script>


@endsection