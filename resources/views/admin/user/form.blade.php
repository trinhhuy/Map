@extends('admin')

@section('content')
        <!-- Page header -->
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h2>
        <a href="" class="btn btn-link">
          <i class="icon-arrow-left8"></i>
        </a>
        {{ isset($user) ? 'Sửa Thành viên ' : 'Thêm Thành viên' }}
      </h2>
    </div>
  </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">
  <!-- Page content -->

    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          @include('admin.flash')
          <div class="panel panel-flat">
            <div class="panel-body">
              <form method="POST" action="{{ isset($user) ? route('Admin::user@update', [$user->id] ): route('Admin::user@store') }}">
                {{ csrf_field() }}
                @if (isset($user))
                  <input type="hidden" name="_method" value="PUT">
                  @endif
                          <!---------- Name------------>
                  <div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
                    <label for="name" class="control-label text-semibold">Họ và tên</label>
                    <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Họ và tên"></i>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?: @$user->name }}" />
                    @if ($errors->has('name'))
                      <div class="form-control-feedback">
                        <i class="icon-notification2"></i>
                      </div>
                      <div class="help-block">{{ $errors->first('name') }}</div>
                    @endif
                  </div>

                <!---------- Code------------>
                <div class="form-group {{ $errors->has('code') ? 'has-error has-feedback' : '' }}">
                  <label for="name" class="control-label text-semibold">Mã nhân viên</label>
                  <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Mã nhân viên"></i>
                  <input type="text" id="code" name="code" class="form-control" value="{{ old('code') ?: @$user->code }}" />
                  @if ($errors->has('code'))
                    <div class="form-control-feedback">
                      <i class="icon-notification2"></i>
                    </div>
                    <div class="help-block">{{ $errors->first('code') }}</div>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('phone') ? 'has-error has-feedback' : '' }}">
                  <label for="name" class="control-label text-semibold">Số điện thoại</label>
                  <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Mã nhân viên"></i>
                  <input type="text" id="code" name="phone" class="form-control" value="{{ old('phone') ?: @$user->phone }}" />
                  @if ($errors->has('code'))
                    <div class="form-control-feedback">
                      <i class="icon-notification2"></i>
                    </div>
                    <div class="help-block">{{ $errors->first('phone') }}</div>
                  @endif
                </div>
                <!---------- Position ------------>
                <div class="form-group {{ $errors->has('code') ? 'has-error has-feedback' : '' }}">
                  <label for="name" class="control-label text-semibold">Chức vụ</label>
                  <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Vị trí"></i>
                  {{--<input type="text" id="position" name="position" class="form-control" value="{{ old('code') ?: @$user->position }}" />--}}
                    <?php  $positions = \App\Models\User::$positionTexts;  ?>
                  <select name="position" id="position" class="form-control">
                    <option value="">-- Chọn chức vụ --</option>
                    @foreach($positions as $key => $value)
                      <option value="{{ $key }}" {{ $key == @$user->position ? "selected=selected" : ""}}>{{ $value }}</option>
                    @endforeach
                  </select>

                  @if ($errors->has('position'))
                    <div class="form-control-feedback">
                      <i class="icon-notification2"></i>
                    </div>
                    <div class="help-block">{{ $errors->first('position') }}</div>
                  @endif
                </div>
                <!---------- Manager ID------------>
                <div class="form-group {{ $errors->has('manager_id') ? 'has-error has-feedback' : '' }}">
                  <label for="name" class="control-label text-semibold">Người Quản Lý</label>
                  <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Người Quản Lý"></i>
                  <select name="manager_id" id="manager" class="form-control">


                  </select>
                  @if ($errors->has('manager_id'))
                    <div class="form-control-feedback">
                      <i class="icon-notification2"></i>
                    </div>
                    <div class="help-block">{{ $errors->first('manager_id') }}</div>
                  @endif
                </div>



                  <!------------------ Email--------------->
                  <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }}">
                    <label for="name" class="control-label text-semibold">Email</label>
                    <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Tên của Doanh nghiệp"></i>
                    <input type="text" @if(isset($user))disabled @endif id="email" name="email" class="form-control" value="{{ old('email') ?: @$user->email }}" />
                    @if ($errors->has('email'))
                      <div class="form-control-feedback">
                        <i class="icon-notification2"></i>
                      </div>
                      <div class="help-block">{{ $errors->first('email') }}</div>
                    @endif
                  </div>
                  <!------------------------- Password-------------------->

                    <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }}">
                      <label for="passwrod" class="control-label text-semibold">Mật khẩu</label>
                      <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Mật khẩu đăng nhập vào hệ thống <strong>iCheck cho doanh nghiệp</strong> của Doanh nghiệp."></i>
                      <input type="password" id="password" name="password" class="form-control" />
                      @if ($errors->has('password'))
                        <div class="form-control-feedback">
                          <i class="icon-notification2"></i>
                        </div>
                        <div class="help-block">{{ $errors->first('password') }}</div>
                      @endif
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error has-feedback' : '' }}">
                      <label for="password-confirmation" class="control-label text-semibold">Xác nhận Mật khẩu</label>
                      <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Nhập lại mật khẩu ở trên."></i>
                      <input type="password" id="password-confirmation" name="password_confirmation" class="form-control" />
                      @if ($errors->has('password_confirmation'))
                        <div class="form-control-feedback">
                          <i class="icon-notification2"></i>
                        </div>
                        <div class="help-block">{{ $errors->first('password_confirmation') }}</div>
                      @endif
                    </div>



                  <div class="form-group {{ $errors->has('textColor') ? 'has-error has-feedback' : '' }}">
                      <label class="control-label col-md-3"> {{trans('home.textColor')}} </label>

                      <div class="input-group color colorpicker-default form-control"
                           data-color="{{(isset($user) and $user->textColor) ? $user->textColor : '#000000'}}"
                           data-color-format="rgba">
                          <input type="text" class="form-control"
                                 value="{{(isset($user) and $user->textColor) ? $user->textColor : '#000000'}}"
                                 name="textColor">
                          <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i
                                                                style="background-color: {{(isset($user) and $user->textColor) ? $user->textColor : '#000000'}};"></i>&nbsp;</button>
                                                </span>
                      </div>
                      @if ($errors->has('textColor'))
                          <div class="form-control-feedback">
                              <i class="icon-notification2"></i>
                          </div>
                          <div class="help-block">{{ $errors->first('textColor') }}</div>
                      @endif
                  </div>
                  <div class="form-group {{ $errors->has('fontSize') ? 'has-error has-feedback' : '' }}">
                      <label for="name" class="control-label text-semibold">{{trans('home.fontSize')}}</label>
                      <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content=""></i>
                      <input type="number" id="fontSize" name="fontSize" class="form-control" value="{{( isset($user) and $user->fontSize) ? $user->fontSize : 12 }}" />
                      @if ($errors->has('fontSize'))
                          <div class="form-control-feedback">
                              <i class="icon-notification2"></i>
                          </div>
                          <div class="help-block">{{ $errors->first('fontSize') }}</div>
                      @endif
                  </div>


                  <!---------- Status ------------>
                <div class="form-group {{ $errors->has('status') ? 'has-error has-feedback' : '' }}">
                  <label for="name" class="control-label text-semibold">Trạng thái</label>
                  <i class="icon-question4 text-muted text-size-mini cursor-pointer js-help-icon" data-content="Trạng thái"></i>
                  <select name="status" class="form-control">
                      <option value="{{ 1 }}" {{ 1 == @$user->status ? "selected=selected" : ""}}>{{ trans('home.active') }}</option>
                      <option value="{{ 0 }}" {{ 2 == @$user->status ? "selected=selected" : ""}}>{{ trans('home.inactive') }}</option>
                  </select>
                  @if ($errors->has('status'))
                    <div class="form-control-feedback">
                      <i class="icon-notification2"></i>
                    </div>
                    <div class="help-block">{{ $errors->first('status') }}</div>
                  @endif
                </div>

                  <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Cập nhật' : 'Thêm mới' }}</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /main content -->

</div>
<!-- /page container -->
@endsection

@push('js_files_foot')
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endpush

@push('scripts_foot')
<script>
  $(document).ready(function () {


      @if(isset($user))
      var value = $('#position').val();
         $.ajax({
          method: "post",
          url: "{{ route('Admin::user@getAccountPosition') }}",
          headers: {
              'X-CSRF-Token': "{{ csrf_token() }}"
          },
          data: {
              position: value,
              manager : '{{$user->manager_id}}'
          },
          dataType: 'html',
          success: function(html){
              $('#manager').html('');
              $('#manager').append(html);
              $('#manager').select2();
          }
      });

      @endif
  $('#position').change(function(){
     var value = $(this).val();
      $.ajax({
          method: "post",
          url: "{{ route('Admin::user@getAccountPosition') }}",
          headers: {
              'X-CSRF-Token': "{{ csrf_token() }}"
          },
          data: {
              position: value
          },
          dataType: 'html',
          success: function(html){
              $('#manager').html('');
              $('#manager').append(html);
              $('#manager').select2();

          }
      });
  });
    // Format icon
    function iconFormat(icon) {
      var originalOption = icon.element;
      if (!icon.id) { return icon.text; }
      var $icon = "<i class='icon-" + $(icon.element).data('icon') + "'></i>" + icon.text;

      return $icon;
    }

    // Initialize with options
    $(".select-icons").select2({
      templateResult: iconFormat,
      minimumResultsForSearch: Infinity,
      templateSelection: iconFormat,
      escapeMarkup: function(m) { return m; }
    });



    // Styled form components
    // ------------------------------

    // Checkboxes, radios
//    $(".js-radio, .js-checkbox").uniform({ radioClass: "choice" });
//
//    // File input
//    $(".js-file").uniform({
//      fileButtonClass: "action btn btn-default"
//    });

    $(".js-tooltip, .js-help-icon").popover({
      container: "body",
      html: true,
      trigger: "hover",
      delay: { "hide": 1000 }
    });

    // Toggle password inputs
    $(document).on('click', 'a#show-password-inputs', function (e) {
      e.preventDefault();

      $('#password-inputs').removeClass('hidden').prev().addClass('hidden');
    });

    $(document).on('click', 'a#hide-password-inputs', function (e) {
      e.preventDefault();

      $('#password-inputs').addClass('hidden').prev().removeClass('hidden');
    });

    @if ($errors->has('password'))
    $('a#show-password-inputs').trigger('click');
    @endif

  });
</script>
@endpush
