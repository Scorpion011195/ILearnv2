    <div class="panel">
        <div class="panel-body">
            {!! Form::open(['route' => 'adminSearchUser','method' => 'get']) !!}
            <div class="row">
                <div class="col-sm-5">
                    {!! csrf_field() !!}
                    {!! Form::label('collect-phrase', 'Tài khoản', ['class' => ' control-label col-sm-4 text-center-vertical text-right']) !!}
                    <div class="col-sm-8 {!! $errors->has('_keytaikhoan') ? ' has-error' : '' !!}">
                        {!! Form::text('_keytaikhoan', '', ['class' => 'form-control','maxlength'=>"32"]) !!}
                    </div>
                </div>
                <div class="col-sm-5">
                    {!! Form::label('collect-date', 'Ngày đăng ký', ['class' => ' control-label col-sm-4 text-center-vertical text-right']) !!}
                    <div class="col-sm-8 {!! $errors->has('_keyngaydk') ? ' has-error' : '' !!} date">
                    {!! Form::text('_keyngaydk', '', ['class' => 'form-control datepicker', 'id' => 'datepicker']) !!}
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="col-sm-3">
                        {!! Form::button('<span class="glyphicon glyphicon-search"></span>',array('class'=>'btn btn-info','type'=>'submit')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                  @if ($errors->has('_keytaikhoan'))
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
            {!! Form::close() !!}
            <br>
            @include('backend.components.user.user-management.account-table')
        </div>
    </div>
    <!-- Modal -->
    @include('backend.components.user.user-management.modal-alert')
