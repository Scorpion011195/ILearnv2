@if (isset($code) && count($errors)<=0)
  @if($code == "RequestInput")
    <div>
        <p class="alert--fail" id="_notify"><span class="glyphicon glyphicon-warning-sign"></span>   Xin hãy nhập Tài khoản hoặc chọn Ngày đăng ký!</p>
    </div>
  @elseif($code == "Success")
    <div>
        <p class="alert--success" id="_notify"><span class="glyphicon glyphicon-ok"></span>   Có {!! $noOfAccounts !!} kết quả được tìm thấy</p>
    </div>
  @endif
@endif
    <!-- /.box-header -->
        <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                    aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th class="text-center col--width05" aria-controls="example1" rowspan="1" colspan="1"
                            aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                            >ID
                            </th>
                            <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Tài khoản
                            </th>
                            <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                    aria-label="Platform(s): activate to sort column ascending">
                    Tình trạng
                            </th>
                            <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                aria-label="Engine version: activate to sort column ascending">
                Quyền
                            </th>
                            <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
            aria-label="CSS grade: activate to sort column ascending">Ngày đăng ký
                            </th>
                            <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
        aria-label="CSS grade: activate to sort column ascending">Hành động
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if(isset($dataSearch))
                            @foreach($dataSearch as $value)
                                <tr role="row" class="odd text-center">
                                    <td class="softing_1"> {{$value->id}}</td>
                                    <td class="softing_1"> {{$value->username}}</td>
                                    <td class="softing_1" id ="{{$value->status}}">@if($value->status == 1)Hoạt Động @else Block @endif</td>
                                    <td class="softing_1"> {{$value->role_id}}</td>
                                    <td class="softing_1"> {{$value->created_at}}</td>
                                    <td colspan="" rowspan="" headers=""><i class="fa fa-trash"></i></td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($dataList as $value)
                                <tr role="row" class="odd text-center">
                                    <td class="softing_1"> {{$value->id}}</td>
                                    <td class="softing_1"> {{$value->username}}</td>
                                    <td class="softing_1" id ="{{$value->status}}">@if($value->status == 1)Hoạt Động @else Block @endif</td>
                                    <td class="softing_1"> {{$value->role_id}}</td>
                                    <td class="softing_1"> {{$value->created_at}}</td>
                                    <td colspan="" rowspan="" headers=""><i class="fa fa-trash"></i></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng cộng có  tài khoản
                </div>
            </div>
            <div class="col-sm-7"></div>
        </div>

