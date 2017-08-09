<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/adminProfile.css')}}">
<div class="container">
<br>
<br>
  <div class="row" id="main">
        <div class="col-md-4 well" id="leftPanel">
            <div class="row">
                <div class="col-md-10">
                 <h3>Chỉnh sửa thông tin !</h3>
                  <div>
                <img src='{{ asset("img/$infomation->image")}}' class="img-circle" height="200px">
                @if(isset($infomation))
                <h2>{{$infomation->name}}</h2>
                <br>
                <p>Bạn là <strong style="color: red">{{$infomation->username}}</strong></p>
                @endif
              </div>
            </div>
            </div>
        </div>
        <div class="col-md-6 well" id="rightPanel">
            <div class="row">
    <div class="col-md-12">
    <form method="post" action="{{ route('updateProfile') }}" accept-charset="UTF-8">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
              <input type="text" name="name" id="name" class="form-control input-lg" placeholder="Tên của bạn" tabindex="1" value="{{$infomation->name}}">
                 @if ($errors->has('name'))
                  <span style="color:red" class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong style="color:red"class=" help-block--color-apple-blossom">{!! $errors->first('name') !!}</strong>
                @endif
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon" id="basic-addon1" style="color:red"><i class="fa fa-phone" aria-hidden="true"></i></span>
              <input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="Số điện thoại " tabindex="2" value="{{$infomation->phone}}">
            </div>
            @if ($errors->has('phone'))
                  <span style="color:red" class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong style="color:red"class=" help-block--color-apple-blossom">{!! $errors->first('phone') !!}</strong>
            @endif
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" value="{{$infomation->email}}" disabled>
      </div>
      <div class="form-group">
      <div class="input-group">
              <span class="input-group-addon" id="basic-addon1" style="color:red"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
        <input type="text" name="address" id="address" class="form-control input-lg" placeholder="Địa chỉ" value="{{$infomation->address}}" tabindex="4">
        </div>
        @if ($errors->has('address'))
                  <span style="color:red" class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong style="color:red"class=" help-block--color-apple-blossom">{!! $errors->first('address') !!}</strong>
            @endif
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar" type="date"></i></span>
              <input type="date" name="dob" id="dob" class="form-control input-lg" placeholder="Password" tabindex="5" value="{{$infomation->date_of_birth}}">
            </div>

          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="6" value="@if(isset($pass)){{ $pass }}@endif">
            @if ($errors->has('password'))
                  <span style="color:red" class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong style="color:red"class=" help-block--color-apple-blossom">{!! $errors->first('password') !!}</strong>
            @endif
          </div>
        </div>
      </div>
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-6"></div>
        <div class="col-xs-12 col-md-6"><button type="submit" class="btn btn-success btn-block btn-lg">Lưu</button></div>
      </div>
    </form>
  </div>
</div>

