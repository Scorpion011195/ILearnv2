<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/adminProfile.css')}}">
<div class="container">
<br>
<br>
  <div class="row" id="main">
        <div class="col-md-4 well" id="leftPanel">
            <div class="row">
                <div class="col-md-10">
                 <h3>Thông tin user : <b style="color:red">{{$infomation->username}}</b></h3>
                  <div>
                <img src="https://img.quantrimang.com/photos/image/2016/03/19/shortcut-chay-ung-dung-duoi-quyen-admin-0.jpg" alt="Texto Alternativo" class="img-circle img-thumbnail" >
                @if(isset($infomation))
                <h2>{{$infomation->name}}</h2>
                <br>
                Ngày tạo: {{$infomation->created_at}}
                @endif
              </div>
            </div>
            </div>
        </div>
        <div class="col-md-6 well" id="rightPanel">
            <div class="row">
    <div class="col-md-12">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
              <input type="text" name="name" id="name" class="form-control input-lg" placeholder="Tên của bạn" tabindex="1" value="{{$infomation->name}}" disabled>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon" id="basic-addon1" style="color:red"><i class="fa fa-phone" aria-hidden="true"></i></span>
              <input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="Số điện thoại " tabindex="2" value="@if(isset($infomation->phone)) {{$infomation->phone}} @else Đang cập nhật @endif" disabled>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" value="{{$infomation->email}}" disabled>
      </div>
      <div class="form-group">
      <div class="input-group">
              <span class="input-group-addon" id="basic-addon1" style="color:red"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
        <input type="text" name="address" id="address" class="form-control input-lg" placeholder="Địa chỉ" value="{{$infomation->address}}" tabindex="4" disabled>
        </div>
        @if ($errors->has('address'))
                  <span style="color:red" class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong style="color:red"class=" help-block--color-apple-blossom">{!! $errors->first('address') !!}</strong>
            @endif
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
              <input  class="form-control input-lg" placeholder="Ngày sinh" tabindex="5" value="{{$infomation->date_of_birth}}" disabled>
            </div>

          </div>
        </div>
        <div class="col-xs-12 col-md-6"><a href="{{route('adminUserManagement')}}" title=""><button type="submit" class="btn btn-default btn-block btn-lg">Quay lại</button></a></div>
      </div>
      <hr class="colorgraph">
  </div>
</div>

