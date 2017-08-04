
    <div class="panel">
        <div class="panel-body">
            <form action="{{ route('adminSearchUser')}}" method="get" role="form">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <h4><b>Tìm theo:</b></h4>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            @if(isset($dataSearch) && count($dataSearch) == 0)
                                <div>
                                    <p class="help-block" style="color:red;">
                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                    <strong>Tài khoản không có trong hệ thống</strong></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                    <div class="col-sm-5">
                        {!! csrf_field() !!}
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" >
                                <label class="control-label col-sm-4 text-center-vertical text-right">Tên tài khoản</label>
                            </span>
                            <input type="text" class="form-control" id="name" placeholder="Nhập tên tài khoản" maxlength ="32" name="nameSearch">
                        </div>
                    </div>
                <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" >
                                <label class="control-label col-sm-4 text-center-vertical text-right">Ngày đăng ký</label>
                            </span>
                            <input type="date" class="form-control" id="datepicker" placeholder="Input field" maxlength ="32" name="dateSearch">
                        </div>
                    </div>
                <div class="col-sm-1">
                    <div class="col-sm-3">
                        <button class="btn btn-success"><span class="glyphicon glyphicon-search"></button>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                  @if ($errors->has(''))
                  <div class="{{ $errors->has('_keytaikhoan') ? ' has-error' : '' }}">
                    <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('_keytaikhoan') !!}</strong></p>
                </div>
                @endif
            </div>
        </div>
        <div class="col-sm-5">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
              @if ($errors->has('_keyngaydk'))
              <div class="{{ $errors->has('_keyngaydk') ? ' has-error' : '' }}">
                <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('_keyngaydk') !!}</strong></p>
            </div>
            @endif
        </div>
    </div>
    <div class="col-sm-2">
    </div>
</div>
</form>
<br>
@include('admin.components.user.user-management.account-table')
</div>
</div>
<!-- Modal -->
@include('admin.components.user.user-management.modal-alert')
