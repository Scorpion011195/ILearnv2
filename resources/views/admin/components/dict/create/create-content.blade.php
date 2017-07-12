
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
      <form class="form-inline margin--top-none" action="{{ route('adminDictCreateWord') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <div class="input-group ">
                <span class="input-group-addon">From</span>
                <select class="form-control" name="_cbnguon">
                  @foreach($listLanguage as $language)
                  <option
                  @if($language->id_language == $idTableNguon)
                  {!! "selected" !!}
                  @endif
                  value="{!! $language->id_language !!}">{!! $language->language !!}</option>
                  @endforeach
                </select>
              </div>
              <select class="form-control" name="_cbloaitu">
                @foreach($listTypeOfWord as $key=>$value)
                <option
                @if($key == $idLoaiTu)
                {!! "selected" !!}
                @endif
                value="{{ $key }}">{!! $value !!}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <div class="input-group ">
                <span class="input-group-addon">To</span>
                <select class="form-control" name="_cbdich">
                  @foreach($listLanguage as $language)
                  <option
                  @if($language->id_language == $idTableDich)
                  {!! "selected" !!}
                  @endif
                  value="{!! $language->id_language !!}">{!! $language->language !!}</option>
                  @endforeach
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
              <span class="input-group-addon">Từ</span>
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
              <span class="input-group-addon">Nghĩa</span>
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
        <br>
        <div class="row">
          <div class="col-sm-6 {{ $errors->has('_tatu') ? ' has-error' : '' }}">
            <lable ><span class="glyphicon glyphicon-info-sign"></span>  Giải thích</lable>
            <textarea class="form-control" placeholder="Giải thích" name="_tatu" id="_gtFrom">{!! old('_tatu') !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace( '_gtFrom',{
              enterMode: Number(2),
            }); </script>
            @if ($errors->has('_tatu'))
            <div>
              <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('_tatu') !!}</strong></p>
            </div>
            @endif
          </div>
          <div class="col-sm-6 {{ $errors->has('_tanghia') ? ' has-error' : '' }}">
            <lable ><span class="glyphicon glyphicon-info-sign"></span>  Giải thích</lable>
            <textarea class="form-control" placeholder="Giải thích" name="_tanghia" id="_gtTo">{!! old('_tanghia') !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace( '_gtTo',{
              enterMode: Number(2),
            }); </script>
            @if ($errors->has('_tanghia'))
            <div>
              <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('_tanghia') !!}</strong></p>
            </div>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>



