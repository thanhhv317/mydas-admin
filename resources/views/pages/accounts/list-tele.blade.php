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
                        Danh sách Tài khoản telegram
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <!-- <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="" class="btn btn-brand btn-icon-sm">
                                <i class="flaticon2-plus"></i> Thêm mới
                            </a>
                        </div>
                    </div> -->
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
                                <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm theo đại lý, người dùng hoặc số điện thoại" id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <button class="btn btn-info  btn_share_account" data-toggle="modal" data-target="#exampleModal" ><i class="flaticon-share"></i> Chia sẻ</button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chia sẻ tài khoản</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            
            <h3> Số lượng tài khoản được chọn: <span class="kt-font-primary kt-font-bold count-account-share">1</span></h3>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Chọn đại lý:</label>
            <select multiple="" class="form-control" name="list-agency" id="exampleSelect2">
                @if(isset($agency))
                @foreach($agency as $key => $value)
                    <option value="{{ $value['Id'] }}">{{ $value['fullname'] }}</option>
                @endforeach
                @endif
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary btn-sharing-account">Chia sẻ</button>
      </div>
    </div>
  </div>
</div>

<?php
    // dd($agency);
    $agency = collect($agency)->mapWithKeys(function($value) {
        return [$value['Id'] => $value['fullname']];
    })->toJson();
?>

@endsection
@section('javascript')
<script>
"use strict";
// Class definition

var KTDatatableRemoteAjaxDemo = function() {
	// Private functions


    var listAgency = {!! $agency !!};

	// basic demo
	var demo = function() {

		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
                        url: '{{ route("accounts.post.showListAccountTele") }}',
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
            toolbar: {
                items: {
                    pagination: {
                        pageSizeSelect: [10, 20, 50, 100, -1]
                    }
                }
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
                    selector: {
                        class: 'kt-checkbox--solid'
                    }
                },  
                {
					field: 'first_name',
					title: 'First name',
                }, 
                {
					field: 'last_name',
					title: 'Last name',
                }, 
                {
					field: 'phone',
					title: 'Điện thoại',
                }, 
                {
					field: 'fullname',
                    title: 'Thuộc đại lý',
                    template: function(data) {
                        let result = '';
                        let idlogin = JSON.parse(data.idlogin);
                        idlogin.forEach((x) => {
                            result += `<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">${listAgency[x]}</span>`
                        });
                        return `
                        <span style="width: 114px;">
                            ${result}
                        </span>
                        `
                    }
                }, 
                {
					field: 'username',
                    title: 'Của người dùng',
                    template: function(data) {
                        return `
                        <span><span class="kt-font-bold kt-font-primary">${data.username}</span></span>                        `;
                    }
				},
                {
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

    let dataAccount = [];

    $(".btn_share_account").on('click', () => {
        var listAccount = [];
        let data = document.querySelectorAll('.kt-checkbox--solid:not(.kt-checkbox--all) > input[type="checkbox"]:checked');
        $.when(data.forEach((x) => {
            listAccount.push(''+x.value);
        })).done(() => {
            $(".count-account-share").text(listAccount.length);
        })

        dataAccount = listAccount;
        // console.log(listAccount);
    })

    $(".btn-sharing-account").click(() => {
        let listAgency = $("select[name='list-agency']").val();
        console.log(dataAccount);
        if (dataAccount !== undefined && dataAccount.length != 0 ) {
            // SHARING
            console.log(listAgency);
            $.ajax({
                url: '{{ route('accounts.post.shareToAgency') }}',
                method: 'POST',
                data: {
                    _token: $("input[name='_token']").val(),
                    dataAccount,
                    listAgency
                },
                success: function(data) {
                    if (data.status == true) {
							Swal.fire(
								'Xong!',
								'Chia sẻ thành công.',
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
        else {
            Swal.fire(
                'Lỗi',
                'Vui lòng chọn tài khoản.',
                'error'
            );
        }
    })
});


</script>


@endsection