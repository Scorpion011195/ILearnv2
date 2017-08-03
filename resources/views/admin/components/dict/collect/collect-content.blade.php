    <div class="panel">
        <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <form class="form-inline margin--top-none" method="POST" action= "{{route('adminDictCollectByOb')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="input-group ">
                        <span class="input-group-addon">Tình trạng</span>
                        <select class="cbselect form-control" name="obCollect">
                           <option value="Added">Added</option>
                           <option value="Waitting">Waitting</option>
                        </select>
                      </div>
                    </div>
                </form>
              </div>
            </div>
            <br>
            <!-- Table -->
            <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="text-center col--width1" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                                </th>
                                <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Từ
                                </th>
                                <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Nghĩa
                                </th>
                                <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    Từ điển
                                </th>
                                <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">
                                    Lượt sử dụng
                                </th>
                                <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">
                                    Từ loại
                                </th>
                                <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">
                                    Tình trạng
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data))
                            <?php $count =count($data) ?>

                                @foreach($data as $value)
                                <?php $typeWord = DB::table('type_words')->where('id',$value->type_word_id)->value('name_type_word');
                                    $lang = DB::table('languages')->where('id',$value->from_language_id)->value('name_language');?>
                                  <tr role="row" class="odd" id="_tr"> 
                                    <td class="text-center align--vertical-middle">{{$value->id}}</td>
                                    <td class="_tdWord text-center align--vertical-middle">{{$value->from_text}}</td>
                                    <td class="_tdMean text-center align--vertical-middle">{{$value->to_text}}</td>
                                    @if($lang == 'Việt')
                                    <td class="_tdLang text-center align--vertical-middle" value="{{$value->from_language_id}}" data-id = "{{$value->from_language_id}}">{{ $lang }}-Anh</td>
                                    @else
                                    <td class="_tdLang text-center align--vertical-middle" value="{{$value->from_language_id}}" data-id = "{{$value->from_language_id}}">{{ $lang }}-Việt</td>
                                    @endif  
                                    <td class="text-center align--vertical-middle">{{$value->quanlity}}</td>
                                    <td class="_tdType text-center align--vertical-middle">{{$typeWord}}</td>
                                    <td class="text-center align--vertical-middle" id= "abc">@if($value->isAvailable =="Added")Added @else <button class="form-control" id = "_waitting">Waitting</button> @endif</td>
                                  </tr>

                                @endforeach

                            @endif
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng cộng có @if(isset($count)){{$count}} @endif kết quả
                        </div>
                    </div>
                    <div class="col-sm-7">
                    </div>
                </div>
            </div>
            <!-- /.Table -->
      
        </div>
    </div>
