<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    @if(isset($results) && count($results) == 0)
        <div>
            <p class="help-block" style="color:red;">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <strong>Từ này đang được cập nhật</strong></p>
        </div>
    @endif
</div>
  <div class="panel">
      <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <form action="{{route('adminSearch')}}" class="form-inline margin--top" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    @if ($errors->has('searchText'))
                      <div class="{{ $errors->has('textSearch') ? ' has-error' : '' }}" style="">
                          <p class="help-block" style="color: red"><span class="glyphicon glyphicon-warning-sign"></span> <strong>{!! $errors->first('searchText') !!}</strong></p>
                      </div>
                  @endif
                    <input class="form-control" type="text" placeholder="Nhập từ" name = "searchText" style = " padding-left: 100px" id="textSearch" value="@if(isset($word)) {{$word}}@endif" required></span>
                    @if(isset($word))
                    <select class="form-control" name="typeWord" id="_typeWord">
                    <option value="" selected>Chọn loại từ !</option>
                      @foreach($typeWord as  $value)
                      @if(isset($RtypeWord) && $RtypeWord == $value->name_type_word)
                        <option value="{!!$value->name_type_word!!}" selected>{!! $value->name_type_word !!}</option>
                      @else
                      
                      <option value="{!!$value->name_type_word!!}">{!! $value->name_type_word !!}</option>
                      @endif
                      @endforeach
                    </select>
                    <div class="input-group ">
                      <span class="input-group-addon">Ngôn ngữ:</span>
                      <select class="form-control" name="languageFrom" id="_lang">
                        @foreach($Lg as $value)
                        @if($value->id == 1){
                          <option value="1">Anh-Việt</option>
                        }
                        <option value="3">Việt-Anh</option>
                        @endif

                        @endforeach
                      </select>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-info" id="submitSearch">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </div>
              </form>
            </div>
          </div>
          <?php $sessionData =  Session::has('searchText'); ?>
           @if(isset($results) && isset($sessionData))
          <br>
          <!-- Table -->
          <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                  <div class="col-sm-12 table-responsive">
                      <table id="example1" class="table table-bordered table-striped dataTable word--break-word" role="grid"
                             aria-describedby="example1_info">
                          <thead>
                          <tr role="row">
                              <th class="text-center col--width05" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">ID
                              </th>
                              <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">Nghĩa
                              </th>
                              <th class="text-center col--width4" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Platform(s): activate to sort column ascending">
                                  Phát âm
                              </th>
                              <!-- If not contributor -->
                              @if((Auth::user()->role_id != 4))
                                <th class="text-center col--width1" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Engine version: activate to sort column ascending">
                                  Hành động
                                </th>
                              @endif
                          </tr>
                          </thead>

                          <tbody>
                                @foreach($results as $key =>$value)
                                <?php $count = count($results) ?>
                                 <tr role="row" class="odd" id="_tr">
                                  <td class="_word-id text-center align--vertical-middle" data-id="{{$value->id}}">{{ $value->id }}</td>
                                  <td class="_word text-center align--vertical-middle" id="_td-word{!! $value->id !!}">{{ $value->word }}</td>
                                  <td class="_pronoun text-center align--vertical-middle">{{ $value->pronounce }}</td>
                                  <td class="text-center align--vertical-middle">
                                  <a class="delete_"><i class="fa fa-trash"></i></a>
                                  <a  class="_update-word" style="padding-left: 5px"  data-toggle="modal" data-target="#myModal"><i class= "fa fa-pencil"></i></a>
                                  </td>
                                  </tr>
                                @endforeach    
                          </tbody> 
                      </table>
                  </div>
              </div>
            @if(isset($results)){!! $results->links() !!}@endif
              <div class="row">
                  <div class="col-sm-5">
                      <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                      @if(isset($results))
                      <p>Có <b style="color:red ">{{$results->total()}} kết quả </b> được tìm thấy</p>
                      @endif
                      </div>
                  </div>
                  <div class="col-sm-7">
                  <a href="" title=""></a>
                  </div>
              </div>
          </div>
          <!-- /.Table -->

      @else
      @endif
        </div>
    </div>

@include('admin.components.dict.search.modal-search')
@include('admin.components.dict.search.modal-success')


