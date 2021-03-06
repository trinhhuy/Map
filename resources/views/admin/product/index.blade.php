@extends('admin')

@section('content')
    <style>
        .dataTables_filter {
            display: none !important;
        }
    </style>
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h2>{!! trans('home.Product') !!}</h2>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="{{route('Admin::product@add')}}" class="btn btn-primary"><i class="icon-add"></i> {!! trans('home.create') . ' ' . trans('home.Product') !!}</a>

                    <a href="#import-product" class="btn btn-info" data-toggle="modal" id="btn-system-product">{{trans('product.addProductExcel')}}</a>
                    <a href="{{asset('product_example.xlsx')}}" class="btn btn-success"  id="btn-system-product">{{trans('product.example')}}</a>
                    <a href="{{route('Admin::product@export')}}" class="btn btn-info" >Export excel</a>
                </div>
            </div>
            <div id="divLoading"></div>
            <div class="modal fade bs-modal-lg" id="import-product" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{trans('product.addProductExcel')}}</h4>
                        </div>
                        <form method="POST" action="{{ route('Admin::product@importExcel') }}"
                              enctype="multipart/form-data" id="import_form">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">File</label>
                                            <div class="col-md-8">
                                                <input type="file" class="file-excel form-control" name="file">
                                            </div>
                                        </div>

                                    </div>
                                    <p id="file" style="color:red;"></p>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{trans('product.close')}}</button>
                                <button type="button" class="btn green" id = "import">Import</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
    <!-- /page header -->
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->

            <div class="content-wrapper">
                @if (session('success'))
                    <div class="alert bg-success alert-styled-left">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        {{ session('success') }}
                    </div>
                @endif
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="products-table">
                            <thead>
                            <tr>

                                <th>Name</th>
                                <th>CBD</th>
                                <th>MaxGreen</th>
                                <th>MaxGrO</th>
                                <th>Group</th>
                                <th>Created_At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
            </div>
            <!-- /main content -->
        </div>

        <!-- /page content -->

    <!-- /page container -->


@endsection

@push('scripts')
<script>
    function xoaCat(){
        var conf = confirm("Bạn chắc chắn muốn xoá?");
        return conf;
    }

    $(document).ready(function() {
        var datatable = $("#products-table").DataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            bSort:false,

            "pageLength": 10,
            ajax: {
                url: '{!! route('Admin::product@datatables') !!}',
                data: function (d) {
                    //
                }
            },
            columns: [
                    @php  $raw_locale = \Session::get('locale'); @endphp
                    @if($raw_locale != null and $raw_locale == 'en')
                        {data: 'name_en', name: 'name_en'},
                    @else
                    {data: 'name_vn', name: 'name_vn'},
                    @endif
                {data: 'cbd', name: 'cbd'},
                {data: 'maxgreen', name: 'maxgreen'},
                {data: 'maxgro', name: 'maxgro'},
                {data: 'group', name: 'group'},
                {data: 'created_at', name: 'created_at',orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],

            initComplete: function () {
                this.api().columns().every(function () {


                    var column = this;
                    var input = document.createElement("input");
                    input.className = "form-control form-filter input-sm";
                    $(input).appendTo($(column.header()))
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });

        $("#import").on("click", function () {
            $("div#divLoading").addClass('show');
            var form = $('#import_form');
            var data = new FormData(form[0]);
            $.ajax({
                headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
                url: $('#import_form').attr('action'),
                type: $('#import_form').attr('method'),
                data: data,
                processData: false,
                cache:false,
                contentType:false,
                dataType: 'JSON',
                success: function (res){
                    $("#file").text('');
                    if (res.status == 'success'){
                        $("div#divLoading").removeClass('show');
                        window.location.reload();
                    } else {
                        $.each(res.errors,function(index, value) {
                            $("div#divLoading").removeClass('show');
                            $("#"+index).text(value);
                        });
                    }
                }
            });
        });

    } );

</script>
@endpush
