<div class="row il-history clearfix">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <center><b><h2>Thêm vào danh sách từ</h2></b></center>
            </div>
            <div class="col-sm-12 panel panel-default">
                <div class="form-inline panel-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row il-history">
                        <div class="col-sm-8 il-language-padding-left">
                            <div class="row il-history">
                                <select class="form-control" name="lagPair" id="lagPair">
                                @foreach ($language as $languageOut)
                                    @foreach ($language as $languageIn)
                                        @if ($languageOut->name_language != $languageIn->name_language) 
                                            <option value = "{!! $languageIn->id !!}_{!! $languageOut->id !!}"
                                            @if(isset($oldLangPair)&&$oldLangPair==$languageIn->id.$languageOut->id)
                                                 selected
                                            @endif
                                            >{!! $languageIn->name_language !!} - {!! $languageOut->name_language !!}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                                </select>
                                <select class="form-control type" id="typeWord">
                                    @foreach($typeWordName as $typeWord)
                                        <option value="{!! $typeWord->language_id !!}" selected>{!! $typeWord->type_word !!}
                                        </option>
                                    @endforeach
                                 </select>
                               <!--  <select id="width_tmp_select">
                                    <option id="width_tmp_option"></option>
                                </select> -->
                            </div>
                            <div class="row il-history">
                                <div class="input-group {{$errors->has('fromText') ? 'has-error' : ''}}">
                                    <span class="input-group-addon">Từ</span>
                                    <input type="text" size="30" name="fromText" class="form-control" id="fromText" placeholder="Hello" required="">
                                </div>
                            <br>
                                @if($errors->has('fromText'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('fromText')!!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4 il-language-padding-right">
                            <div class="row il-history">
                                <button type="submit" class="btn btn-success ilearn-background-color" id ="btnAddHistory">
                                <span class="glyphicon glyphicon-upload"></span>Thêm
                                </button>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                  <span class="glyphicon glyphicon-cog"></span>Cài đặt
                                </button>
                            </div>
                            <div class="row il-history">
                                <div class="input-group {{$errors->has('toText') ? 'has-error' : ''}}">
                                    <span class="input-group-addon">Nghĩa</span>
                                    <input type="text" size="30" name="toText" class="form-control" id="toText" placeholder="Hello" required="">
                                </div>
                                <br>
                                @if($errors->has('toText'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('toText')!!}</strong>
                                    </span>
                                @endif
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- Modal -->
<div class="col-sm-12 col-md-12 col-sm-offset-4 col-md-offset-2 col-lg-6 col-lg-offset-3">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title"><center>Cài đặt thông báo<center></h2>
            </div>
            <div class="modal-body">
                <div class="il-modal-set">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <label for="" class=" col-md-6" name="">Thông báo</label>
                        <div class="col-md-6"><input type="checkbox" id="toggle-one" data-toggle="toggle"  data="ON" data-off="OFF"
                         @if(($getSettingUser->isOn) == 'ON')
                            {{ "checked" }}
                         @endif
                        >
                        </div>
                    </div>
                    <br>
                    <div class="row">
                      <label for="" class="col-md-6">Thời gian</label>
                        <div class="col-md-6">
                            <select id="_time" class="form-control">
                               @if(isset($getTimeReminder))
                                    @foreach($getTimeReminder as $timeReminder)
                                        <option value="{!! $timeReminder->id !!}" 
                                        @if(($getSettingUser->time_reminder_id) == ($timeReminder->id))
                                            {{ "selected" }}
                                        @endif
                                        >
                                        {!! $timeReminder->time !!}</option>
                                    @endforeach
                               @endif
                            </select>
                        </div>
                    </div>
                     <br>
                    <div class="row">
                        <label for="" class="col-md-6">Hiển thị</label>
                        <div class="col-md-6">
                            <select id="_typeRemind" class="form-control">
                                 @if(isset($getTypeReminder))
                                    @foreach( $getTypeReminder as $typeReminder)
                                        <option value="{!! $typeReminder->id !!}"
                                            @if(($getSettingUser->type_reminder_id) == ($typeReminder->id))
                                                {{ "selected" }}
                                            @endif 
                                        >{!! $typeReminder->type !!}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="_save-setting">Lưu</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div> 
        </div>
    </div>
</div>