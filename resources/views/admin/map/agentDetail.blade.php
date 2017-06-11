@extends('admin')
@push('style_head')

@endpush
@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="col-md-9">
                <div class="page-title">
                    <h2>{{ trans('home.agency') }} : {{$agent->name}}</h2>
                    <h4>{{ trans('home.manager') }}: {{$agent->user->email}}</h4>
                </div>
            </div>
            {{--<div class="col-md-3">--}}
            {{--<div class="page-title button-change-size-map">--}}
            {{--<input type="checkbox" id="change-button-size-map" name="checkbox" @if(Request::input('size-map') == 'fullscreen') checked @endif class="make-switch" data-on-text="&nbsp;FullScreen&nbsp;" data-off-text="&nbsp;Landscape&nbsp;">--}}
            {{--</div>--}}

            {{--</div>--}}
            <div class="clearfix"></div>

        </div>

    </div>

    <div class="page-container">
        <div class="content-wrapper">
            @include('admin.flash')

            <div class="row">

                <div class="baomap col-xs-6">
                    <div id="map"></div>
                </div>
                {{--số liệu--}}
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('month') ? 'has-error has-feedback' : '' }}">
                        <label for="name" class="control-label text-semibold col-md-3">{{ trans('home.time') }}</label>
                        <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon"
                           data-content="Thời gian"></i>
                        <div class="col-md-9">
                            <input type="text" id="month" name="month" class="form-control monthPicker col-md-9"
                                   value="{{ old('month') ?: $month }}"/>
                        </div>
                        @if ($errors->has('month'))
                            <div class="form-control-feedback">
                                <i class="icon-notification2"></i>
                            </div>
                            <div class="help-block">{{ $errors->first('month') }}</div>
                        @endif
                    </div>

                    @if(count($products))
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="users-table">
                            <thead>
                            <tr>
                                <th>{{ trans('home.Product') }}</th>
                                <th>{{ trans('home.sale_plan') }}</th>
                                <th>{{ trans('home.sale_real') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $p)
                                <tr role="row" id="">
                                    <td>{{$p->product->name}}</td>
                                    <td>{{$p->sales_plan}}</td>
                                    <td>{{$p->sales_real}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                </div>

            </div>
        </div>
    </div>

@endsection
@push('scripts_foot')
<script src="/assets/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyDUMRn1pnBk97Zay94WiBbMgdVlBh_vwYs&libraries=drawing"></script>
<script type="text/javascript" src="/js/gmaps.js"></script>
<script type="text/javascript" src="/js/prettify.js"></script>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {

        $('.monthPicker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'mm-yy',
            onClose: function (dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
                var url = window.location.origin + window.location.pathname;
                url = url + '?month=' + $(this).val();
                window.location.href = url;
            }
        });


        var heightPageContent = $('.page-content').height();
        var heightPageHeader = $('.page-header-content').height();
        $('.baomap').height(heightPageContent - heightPageHeader);
        var polygonArray = [];
        map = new GMaps({
            div: '#map',
            lat: 21.0277644,
            lng: 105.83415979999995,
            width: "100%",
            height: '100%',
            zoom: 12,
            fullscreenControl: true
        });
        var contentString = '<div id="content">' +
                '<p id="name">' + "{{$agent->name}}" + '</p>' +
                '<p id="manager">' + '{{$agent->user->email}}' + '</p>' +

                '</div>';

        var infoWindow = new google.maps.InfoWindow({
            content: contentString
        });

        map.addMarker({
            lat: "{{$agent->lat}}",
            lng: "{{$agent->lng}}",
            click: function (e) {
                infoWindow.setPosition({lat: e.position.lat(), lng: e.position.lng()});
                infoWindow.open(map.map);
            }
        });


    });

</script>

@endpush