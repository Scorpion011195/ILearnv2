    <div class="panel">
        <div class="panel-body">
            @if(session('alertUpdateDetailUser'))
            <div>
              <p class="alert--success"><span class="glyphicon glyphicon-ok"></span>   {!! session('alertUpdateDetailUser') !!}</p>
            </div>
            @endif
            @foreach ($data as $value)
                <div class="row">
                    <lable class="control-label col-sm-4 text-center-vertical">Email</lable>
                    <div class="col-sm-8">
                        <input type="text" name="profile-email" class="form-control" readonly value='{{$value->email}}'>
                    </div>
                </div>
                <div class="row margin-top">
                    <lable class="control-label col-sm-4 text-center-vertical">Tên</lable>
                    <div class="col-sm-8">
                        <input type="text" name="profile-name" maxlength="50" class="form-control" readonly value="{{$value->name}}">
                    </div>
                </div>
                <div class="row margin-top">
                    <lable class="control-label col-sm-4 text-center-vertical">Địa chỉ</lable>
                    <div class="col-sm-8">
                    @if(isset($value->address))
                        <input type="text" name="profile-address" maxlength="100" class="form-control" readonly value="{{$value->address}}">
                    @else
                        <input type="text" name="profile-address" maxlength="100" class="form-control" readonly value="Đang cập nhật">
                    @endif
                    </div>

                </div>
                <div class="row margin-top">
                    <lable class="control-label col-sm-4 text-center-vertical">Số điện thoại</lable>
                    <div class="col-sm-8 ">
                     @if(isset($value->phone))
                        <input type="text" name="profile-phone" maxlength="11" class="form-control" value="{{$value->phone}}" readonly>
                      @else
                      <input type="text" name="profile-phone" maxlength="100" class="form-control" readonly value="Đang cập nhật">
                    </div>
                    @endif
                </div>
                <div class="row margin-top">
                    <lable class="control-label col-sm-4 text-center-vertical">Ngày sinh</lable>
                    <div class="col-sm-8">
                      @if(isset($value->date_of_birth))
                        <input type="text" name="profile-dob" class="form-control" readonly value="{{$value->date_of_birth}}">
                      @else
                      <input type="text" name="profile-dob" class="form-control" readonly value="Đang cập nhật">
                      @endif
                    </div>
                </div>
          <br>
                <div class="row text-center">
                    <a href="{{route('adminUserManagement')}}" title=""><input type="submit" class="btn btn-info margin-top text-center" value="Trở về"></a>
                </div>
        </div>
        @endforeach
    </div>
