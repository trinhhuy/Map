@extends('admin')

@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h2>Danh sách các vùng</h2>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    {{--<a href="{{route('Admin::user@add')}}" class="btn btn-primary"><i class="icon-add"></i> Thêm thành viên</a>--}}

                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->

        <div class="content-wrapper">
           @include('admin.flash')
            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="users-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Màu của border</th>
                    <th>Màu nền</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($areas as $area)
                    <tr role="row" id="">
                        <td>{{$area->name}}</td>
                        <td>{{$area->border_color}}</td>
                        <td>{{$area->background_color}}</td>
                        {{--<td>@foreach ($row->roles as $role)--}}
                                {{--{{$role->name}}--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td>{{$row->created_at}}</td>--}}
                        {{--<td><a href="{{route('Admin::user@edit',[$row->id])}}"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-pro">Edit</button></a>--}}
                            {{--<a onclick="return xoaCat();" href="{{ route('Admin::user@delete', [$row->id]) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>--}}
                    </tr>
                @endforeach
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

//    $(document).ready(function() {
//        $('#users-table').DataTable({
//            "bInfo" : false,
//            "columns":[
//                {
//                    "sortable": true
//                },
//                {
//                    "sortable": false
//                },
//                {
//                    "sortable": false
//                },
//                {
//                    "sortable": false
//                },
//                {
//                    "sortable": false
//                }
//            ]
//        });
//    } );

</script>
@endpush