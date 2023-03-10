@extends('layouts.master')
@section('title')
Bills list
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/تفاصيل الفاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

				<!-- row -->
				<div class="row">
                @section('content')

                @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


                @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">

								</div>
							</div>
							<div class="d-md-flex">
	<div class="">
		<div class="panel panel-primary tabs-style-4">
			<div class="tab-menu-heading">
				<div class="tabs-menu ">
					<!-- Tabs -->
					<ul class="nav panel-tabs">
						<li class=""><a href="#tab21" class="active" data-toggle="tab"><i class="fa fa-laptop"></i>معلومات الفاتورة</a></li>
						<li><a href="#tab22" data-toggle="tab"><i class="fa fa-cube"></i>حالات الدفع</a></li>
						<li><a href="#tab23" data-toggle="tab"><i class="fa fa-cogs"></i>المرفقات</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<div class="tabs-style-4">
		<div class="panel-body tabs-menu-body">
			<div class="tab-content">
				<div class="tab-pane active" id="tab21">
                <div class="card card-statistics">
                <div class="table-responsive mt-15">
                <table  class="table table-hover key-buttons text-md-nowrap" style="text-align:center">
										<thead>
											<tr>
												<th class="border-bottom-0">اسم المستخدم</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الأصدار</th>
												<th class="border-bottom-0">تاريخ الأستحقاق</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">مبلغ التحصيل</th>
												<th class="border-bottom-0">مبلغ العمولة</th>
												<th class="border-bottom-0">نسبة الضريبة</th>
												<th class="border-bottom-0">قيمة الضريبة</th>
												<th class="border-bottom-0">الحالة</th>
												<th class="border-bottom-0">الملاحظات</th>
												<th class="border-bottom-0">الأجمالي</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{Auth::user()->name}}</td>
												<td>{{$all_invoices->invoice_number}}</td>
												<td>{{$all_invoices->invoice_Date}}</td>
												<td>{{$all_invoices->Due_date}}</td>
												<td>{{$all_invoices->section->section_name}}</td>
												<td>{{$all_invoices->product}}</td>
												<td>{{$all_invoices->Discount}}</td>
												<td>{{$all_invoices->Amount_collection}}</td>
												<td>{{$all_invoices->Amount_Commission}}</td>
												<td>{{$all_invoices->Rate_VAT}}</td>
												<td>{{$all_invoices->Value_VAT}}</td>
                                                <td>
                                                    @if($all_invoices->value_status == 1)
                                                        <span class="badge badge-pill badge-success">{{$all_invoices->status}}</span>
                                                    @elseif($all_invoices->value_status == 2)
                                                        <span class="badge badge-pill badge-danger">{{$all_invoices->status}}</span>
                                                    @else
                                                        <span class="badge badge-pill badge-warning">{{$all_invoices->status}}</span>
                                                    @endif
                                                </td>
												<td>{{$all_invoices->note}}</td>
												<td>{{$all_invoices->Total}}</td>
											</tr>
										</tbody>
									</table>
				</div>
				</div>
				</div>
				<div class="tab-pane" id="tab22">
                <div class="card card-statistics">
                <div class="table-responsive mt-15">
                <table class="table table-hover key-buttons text-md-nowrap" style="text-align:center">
										<thead>
											<tr>
												<th class="border-bottom-0">ID</th>
												<th class="border-bottom-0">اسم المستخدم</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">نوع المنتج</th>
												<th class="border-bottom-0">تاريخ الدفع</th>
												<th class="border-bottom-0">حالة الدفع</th>
												<th class="border-bottom-0">تاريخ الأضافة</th>
												<th class="border-bottom-0">الملاحظات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $i = 0 ?>
                                            @foreach($all_details as $details)
                                            <?php $i++ ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{Auth::user()->name}}</td>
												<td>{{$details->invoice_number}}</td>
												<td>{{$all_invoices->section->section_name}}</td>
												<td>{{$details->product}}</td>
												<td>{{$all_invoices->payment_date}}</td>
                                                <td>
                                                    @if($details->value_status == 1)
                                                    <span class="badge badge-pill badge-success">{{$details->status}}</span>
                                                    @elseif($details->value_status == 2)
                                                    <span class="badge badge-pill badge-danger">{{$details->status}}</span>
                                                    @else
                                                    <span class="badge badge-pill badge-warning">{{$details->status}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$details->created_at}}</td>
												<td>{{$details->note}}</td>
											</tr>
                                            @endforeach
										</tbody>
									</table>
				</div>
				</div>
				</div>
				<div class="tab-pane" id="tab23">
                            <div class="card card-statistics">
                    <div class="table-responsive mt-15">
                <table class="table table-hover key-buttons text-md-nowrap" style="text-align:center">

                                                    @can('اضافة مرفق')
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $all_invoices->invoice_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $all_invoices->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                    </div>
                                                    @endcan
                                                <br>
										<thead>
											<tr>
												<th class="border-bottom-0">ID</th>
												<th class="border-bottom-0">اسم الملف</th>
												<th class="border-bottom-0">اسم المستخدم</th>
												<th class="border-bottom-0">تاريخ الأضافة</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $i = 0 ?>
                                            @foreach($all_attachments as $attachments)
                                            <?php $i++ ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$attachments->file_name}}</td>
												<td>{{Auth::user()->name}}</td>
                                                <td>{{$attachments->created_at}}</td>
												<td colspan="2">

                                                <a class="btn btn-outline-success btn-sm"
                                                href="{{ url('View_file') }}/{{ $all_invoices->invoice_number }}/{{ $attachments->file_name }}"
                                                role="button"><i class="fas fa-eye"></i>&nbsp;
                                                عرض</a>

                                                <a class="btn btn-outline-info btn-sm"
                                                href="{{ url('download') }}/{{ $all_invoices->invoice_number }}/{{ $attachments->file_name }}"
                                                role="button"><i
                                                class="fas fa-download"></i>&nbsp;تحميل</a>

                                                @can('حذف المرفق')
                                                <button class="btn btn-outline-danger btn-sm"
                                                data-toggle="modal"
                                                data-file_name="{{ $attachments->file_name }}"
                                                data-invoice_number="{{ $attachments->invoice_number }}"
                                                data-id_file="{{ $attachments->id }}"
                                                data-target="#delete_file">حذف</button>
                                                @endcan
                                                </td>
				                            </tr>
                                        @endforeach
				                    </tbody>
						            </table>
                                </div>
				            </div>
			            </div>
		            </div>
	            </div>
            </div>
                </div>
					</div>
					<!--/div-->
				        </div>
				<!-- /row -->
                <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('delete_file') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection


@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
@endsection
