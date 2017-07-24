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
                            <th class="text-center " aria-controls="example1" rowspan="1" colspan="1"
                            aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                            >ID
                            </th>
                            <th class="text-center " aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Tài khoản
                            </th>
                            <th class="text-center " aria-controls="example1" rowspan="1" colspan="1"
                    aria-label="Platform(s): activate to sort column ascending">
                    Tình trạng
                            </th>
                            <th class="text-center " aria-controls="example1" rowspan="1" colspan="1"
                aria-label="Engine version: activate to sort column ascending">
                Quyền
                            </th>
                            <th class="text-center " aria-controls="example1" rowspan="1" colspan="1"
            aria-label="CSS grade: activate to sort column ascending">Ngày đăng ký
                            </th>
                            <th class="text-center " aria-controls="example1" rowspan="1" colspan="1"
        aria-label="CSS grade: activate to sort column ascending">Hành động
                            </th>
                        </tr>
                    </thead>
                    <tbody>     
                    @if(isset($dataSearch))
                        @foreach($dataSearch as $value)
                        <?php $id = $value->id ?>
                            <tr role="row" class="odd text-center">
                                <td class="_user-id softing_1" data-id="{{ $id }}"> {{ $id }}</td>
                                <td class="_user-name softing_1"> {{$value->username}}</td>
                                <td class="softing_1" id ="{{$value->status}}">
                                    <select class="form-control" id="sel1" value="">
                                    @if( $value->status == 1) 
                                        <option id="1" selected  >Hoạt động</option>
                                         <option id="0" >Block</option>
                                    @else($value->status = 0)
                                        <option  id="0"selected ">Block</option>
                                        <option id="1">Hoạt động</option>
                                    @endif
                                </select>
                                </td>
                                <td class="softing_1">
                                    <select class="form-control" id="selRole">
                                        @foreach($roleUser as $role)
                                            @if($value->role_id == $role->id)
                                                <option id = "role"  value="{{$role->id}}" selected>{{$role->role}}</option>
                                            @else
                                                <option id ="role" value="{{$role->id}}" >{{$role->role}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td class="softing_1"> {{$value->created_at}}</td>
                                <td class="softing_1"> 
                                 <a class="edit" href="{{ route('adminGetDetailUser',$value->id) }}"><i class="fa fa-pencil"></i></a>
                                <a class="delete" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($dataList as $value)
                        <?php $id = $value->id ?>
                            <tr role="row" class="odd text-center">
                                <td class="_user-id softing_1" data-id="{{ $id }}"> {{ $id }}</td>
                                <td class="_user-name softing_1"> {{$value->username}}</td>
                                <td class="softing_1" id ="{{$value->status}}">
                                    <select class="form-control" id="sel1" value="{{$value->status}}">
                                    @if( $value->status == 1) 
                                        <option selected>Hoạt động</option>
                                         <option>Block</option>
                                    @else($value->status = 0)
                                        <option  >Block</option>
                                         <option>Hoạt động</option>
                                    @endif
                                </select>
                                </td>
                                <td class="softing_1">
                                    <select class="form-control" id="selRole">
                                        @foreach($roleUser as $role)
                                            @if($value->role_id == $role->id)
                                                <option id ="role" value="{{$role->id}}" selected>{{$role->role}}</option>
                                            @else
                                                <option id ="role" value="{{$role->id}}" >{{$role->role}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td class="softing_1"> {{$value->created_at}}</td>
                                <td class="softing_1"> 
                                <a class="edit" href="{{route('adminGetDetailUser',$id)}}"><i class="fa fa-pencil"></i></a>
                                <a class="delete"><i class="fa fa-trash"></i></a>
                                </td>
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
            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng cộng có <b style="color: red;">{{$count}} tài khoản</b>
            </div>
        </div>
        <div class="col-sm-7"></div>
    </div>

