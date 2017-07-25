
  <div class="panel">
    <div class="panel-body">
    @if(isset($message))
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <div class="alert alert-info" role="alert">{!! $message!!}</div>
    @endif
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
      <form class="form-inline margin--top-none" action="{{ route('adminAdd') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <div class="input-group ">
                <span class="input-group-addon"><b>From</b></span>
                <select class="form-control" name="fromLg" >
                  @if(isset($languages))
                    @foreach($languages as $language)
                        <option value="{!! $language->id !!}"> {!! $language->name_language !!} ({!!$language->code_language!!})</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <select class="form-control" name="typeWord" >
                @if(isset($typeWord))
                    @foreach($typeWord as $value)
                      <option value="{{ $value->name_type_word }}">{!! $value->name_type_word !!}</option>
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
          <div class="col-sm-6 {{ $errors->has('fromText') ? ' has-error' : '' }}">
            <div class="input-group ">
              <span class="input-group-addon"><b>Từ</b></span>
              <input size="36" id="msg" required maxlength="50" type="text" class="form-control" name="fromText" placeholder="hello"
              @if(isset($from))
                value="{!! $from !!}"
              @endif >
            </div>
            @if ($errors->has('fromText'))
            <span class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong class="help-block--color-apple-blossom">{!! $errors->first('fromText') !!}</strong>
            @endif
          </div>
          <div class="col-sm-6 {{ ($errors->has('toText')&&!($errors->has('fromText'))) ? ' has-error' : '' }}">
            <div class="input-group">
              <span class="input-group-addon" disable><b>Nghĩa</b></span>
              <input size="30" id="msg" required maxlength="50" type="text" class="form-control" name="toText" placeholder="xin chào"
              @if (isset($from)&&isset($to))
                value="{!! $to !!}"
              @endif >
            </div>
            @if ($errors->has('toText')&&!($errors->has('fromText')))
            <span class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong class="help-block--color-apple-blossom">{!! $errors->first('toText') !!}</strong>
            @endif
          </div>
            <div class="col-sm-6 {{ ($errors->has('pronoun')&&!($errors->has('fromText'))) ? ' has-error' : '' }}" style ="padding-top: 20px">
            <div class="input-group">
              <span class="input-group-addon" disable><b>Phát âm</b></span>
              <input size="30" id="msg" type="text" class="form-control" name="pronoun" placeholder="heˈlō,həˈlō" 
              @if(isset($pronoun) && isset($from))
                value="{{ $pronoun }}"
               @endif>
            </div>
            @if ($errors->has('pronoun')&&!($errors->has('fromText')))
            <span class="glyphicon glyphicon-warning-sign help-block--color-apple-blossom"></span>   <strong class="help-block--color-apple-blossom">{!! $errors->first('pronoun') !!}</strong>
            @endif
          </div>
        </div>
        <hr>
      </form>
    </div>
  </div>



