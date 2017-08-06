    <div class="panel">
        <div class="panel-body">
            @if(session('alertUpdatePassword'))
                @if(session('alertUpdatePassword')=='failPass')
                    <div>
                      <p class="alert--fail"><span class="glyphicon glyphicon-warning-sign"></span>   Mật khẩu cũ không đúng!</p>
                    </div>
                @elseif(session('alertUpdatePassword')=='failPassConfirm')
                    <div>
                      <p class="alert--fail"><span class="glyphicon glyphicon-warning-sign"></span>   Xác nhận mật khẩu không đúng!</p>
                    </div>
                @else
                    <div>
                      <p class="alert--success"><span class="glyphicon glyphicon-ok"></span>   Đã thay đổi mật khẩu thành công!</p>
                    </div>
                @endif
            @endif
            <form action="{{ route('adminPostChangePassword') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row margin-top">
                    <lable class="control-label col-sm-4 text-center-vertical">Mật khẩu cũ</lable>
                    <div class="col-sm-8 {!! $errors->has('profile-password-old') ? ' has-error' : '' !!}">
                        <input type="password" name="profile-password-old" class="form-control" value="{!! old('profile-password-old') !!}" required minlength="6" maxlength="32">
                    </div>
                </div>
                @if ($errors->has('profile-password-old'))
                  <div>
                    <div class="control-label col-sm-4 text-center-vertical"></div>
                    <div class="col-sm-8 {!! $errors->has('profile-password-old') ? ' has-error' : '' !!}">
                      <div>
                          <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('profile-password-old') !!}</strong></p>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row margin-top">
                    <lable class="control-label col-sm-4 text-center-vertical">Mật khẩu mới</lable>
                    <div class="col-sm-8 {!! $errors->has('profile-password-new') ? ' has-error' : '' !!}">
                        <input type="password" name="profile-password-new" class="form-control" value="{!! old('profile-password-new') !!}" required minlength="6" maxlength="32">
                    </div>
                </div>
                @if ($errors->has('profile-password-new'))
                  <div>
                    <div class="control-label col-sm-4 text-center-vertical"></div>
                    <div class="col-sm-8 {!! $errors->has('profile-password-new') ? ' has-error' : '' !!}">
                      <div>
                          <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('profile-password-new') !!}</strong></p>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row margin-top">
                    <lable class="control-label col-sm-4 text-center-vertical">Nhập lại mật khẩu mới</lable>
                    <div class="col-sm-8 {!! $errors->has('profile-password-new-confirm') ? ' has-error' : '' !!}">
                        <input type="password" name="profile-password-new-confirm" class="form-control" value="{!! old('profile-password-new-confirm') !!}" required minlength="6" maxlength="32">
                    </div>
                </div>
                @if ($errors->has('profile-password-new-confirm'))
                  <div>
                    <div class="control-label col-sm-4 text-center-vertical"></div>
                    <div class="col-sm-8 {!! $errors->has('profile-password-new-confirm') ? ' has-error' : '' !!}">
                      <div>
                          <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('profile-password-new-confirm') !!}</strong></p>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row text-center">
                    <input type="submit" class="btn btn-info margin-top text-center" value="Thay đổi mật khẩu">
                </div>
            </form>
        </div>
    </div>
