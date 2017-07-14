
  <div class="panel">
    <div class="panel-body">
      @if ($errors->has('Success'))
      <div>
        <p class="alert--success"><span class="glyphicon glyphicon-ok"></span>   {!! $errors->first('Success') !!}</p>
      </div>
      @endif
      @if ($errors->has('FailedCannotFind'))
      <div>
        <p class="alert--fail"><span class="glyphicon glyphicon-warning-sign"></span>   {!! $errors->first('FailedCannotFind') !!}</p>
      </div>
      @endif
      <form class="form-inline margin--top-none" action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <div class="input-group ">
                <span class="input-group-addon"><b>From</b></span>
                <select class="form-control" name="fromLg">
                  @if(isset($languages))
                    @foreach($languages as $language)
                        <option value="{!! $language->id !!}"> {!! $language->name_language !!} ({!!$language->code_language!!})</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <select class="form-control" name="typeWord">
                @if(isset($typeWord))
                    @foreach($typeWord as $value)
                      <option value="{{ $value->id }}">{!! $value->name_type_word !!}</option>
                    @endforeach
                @endif
              </select>         
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <div class="input-group ">
                <span class="input-group-addon"><b>To</b></span>
                <select class="form-control" name="toLg">
                @if(isset($languages))
                  @foreach($languages as $language)
                  <option value="{!! $language->id !!}"> {!! $language->name_language !!} ({!!$language->code_language!!})</option>
                  @endforeach
                @endif
                </select>
              </div>
              <button type="submit" class="btn btn-info">
                <span class="glyphicon glyphicon-upload"></span>  Thêm
              </button>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-6 {{ $errors->has('_txttu') ? ' has-error' : '' }}">
            <div class="input-group ">
              <span class="input-group-addon"><b>Từ</b></span>
              <input size="30" id="msg" required maxlength="50" type="text" class="form-control" name="_txttu" placeholder="hello"
              @if (!$errors->has('_txttu'))
                value="{!! old('_txttu') !!}"
              @endif >
            </div>
            @if ($errors->has('_txttu'))
            <span class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong class="help-block--color-apple-blossom">{!! $errors->first('_txttu') !!}</strong>
            @endif
          </div>
          <div class="col-sm-6 {{ ($errors->has('_txtnghia')&&!($errors->has('_txttu'))) ? ' has-error' : '' }}">
            <div class="input-group">
              <span class="input-group-addon" disable><b>Nghĩa</b></span>
              <input size="30" id="msg" required maxlength="50" type="text" class="form-control" name="_txtnghia" placeholder="xin chào"
              @if (!$errors->has('_txttu')&&!$errors->has('_txtnghia'))
                value="{!! old('_txtnghia') !!}"
              @endif >
            </div>
            @if ($errors->has('_txtnghia')&&!($errors->has('_txttu')))
            <span class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong class="help-block--color-apple-blossom">{!! $errors->first('_txtnghia') !!}</strong>
            @endif
          </div>
        </div>
        <hr>
      </form>
    </div>
  </div>



