<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>User tương tác nhiều!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left" data-toggle="Modal" data-target="#collect">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>Tổng số lượng User!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left" data-toggle=""  data-target="#news">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
                        <div>User bị block!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"  data-toggle="collapse" data-target="#block">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><h4><b>13</b></h4></div>
                        <div>Admin!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Tương tác -->
<div class="row">
    <div class="col-lg-12" id="collect" class="modal fade" role="dialog" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user-o fa-fw"></i>  Danh sách User tương tác nhiều nhất</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">     
                    <table class="table">
                        <thead>
                          <tr>
                            <th class="text-center">Tên user</th>
                            <th class="text-center">Tên đăng nhập</th>
                            <th class=" text-center">Email</th>
                            <th class=" text-center">Số điện thoại</th>
                            <th class=" text-center">Số lượng truy cập</th>
                          </tr>
                       </thead>
                        <tbody>
                            @foreach($data as $value)
                                <tr>
                                   <td class=" text-center" > {{$value->name}}</td>
                                   <td class=" text-center"> {{$value->username}}</td>
                                   <td class=" text-center"> {{$value->email}}</td>
                                   <td class=" text-center"> {{$value->phone}}</td>
                                   <td class=" text-center"> {{$value->NOU}}</td>
                               </tr>
                            @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
 <!-- End tuowgn tác -->
<!-- Tất cả block -->
     <div class="col-lg-12" id="block" class="collapse">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user-o fa-fw"></i> Danh sách User</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">     
                    <table class="table">
                        <thead>
                          <tr>
                            <th class="text-center">Tên user</th>
                            <th class="text-center">Tên đăng nhập</th>
                            <th class=" text-center">Email</th>
                            <th class=" text-center">Số điện thoại</th>
                            <th class=" text-center">Địa chỉ</th>
                            <th class=" text-center">Ngày tạo</th>
                          </tr>
                       </thead>
                        <tbody>
                            @foreach($data as $value)
                                @if($value->status == 0)
                                    <tr>
                                       <td class=" text-center" > {{$value->name}}</td>
                                       <td class=" text-center"> {{$value->username}}</td>
                                       <td class=" text-center">  @if($value->email == "")Đang cập nhật @else{{$value->email}}@endif</td>
                                       <td class=" text-center">  @if($value->phone == "")Đang cập nhật @else{{$value->phone}}@endif</td>
                                       <td class=" text-center"> @if($value->address == "")Đang cập nhật @else{{$value->address}}@endif</td>
                                       <td class=" text-center"> {{$value->created_at}}</td>
                                   </tr>
                                @endif
                            @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
<!-- End block -->
<!-- ALL -->
    <div class="col-lg-12" id="all" class="collapse">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user-o fa-fw"></i> Danh sách User</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">     
                    <table class="table">
                        <thead>
                          <tr>
                            <th class="text-center">Tên user</th>
                            <th class="text-center">Tên đăng nhập</th>
                            <th class=" text-center">Email</th>
                            <th class=" text-center">Số điện thoại</th>
                            <th class=" text-center">Địa chỉ</th>
                            <th class=" text-center">Ngày tạo</th>
                          </tr>
                       </thead>
                        <tbody>
                            @foreach($data as $value)
                                <tr>
                                   <td class=" text-center" > {{$value->name}}</td>
                                   <td class=" text-center"> {{$value->username}}</td>
                                   <td class=" text-center">  @if($value->email == "")Đang cập nhật @else{{$value->email}}@endif</td>
                                   <td class=" text-center">  @if($value->phone == "")Đang cập nhật @else{{$value->phone}}@endif</td>
                                   <td class=" text-center"> @if($value->address == "")Đang cập nhật @else{{$value->address}}@endif</td>
                                   <td class=" text-center"> {{$value->created_at}}</td>
                               </tr>
                            @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
    <!-- End all -->
    <!-- Admin -->
    <div class="col-lg-12" id="admin" class="collapse">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user-o fa-fw"></i> Danh sách User</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">     
                    <table class="table">
                        <thead>
                          <tr>
                            <th class="text-center">Tên user</th>
                            <th class="text-center">Tên đăng nhập</th>
                            <th class=" text-center">Email</th>
                            <th class=" text-center">Số điện thoại</th>
                            <th class=" text-center">Địa chỉ</th>
                            <th class=" text-center">Ngày tạo</th>
                          </tr>
                       </thead>
                        <tbody>
                            @foreach($data as $value)
                                @if($value->role_id !== 5)
                                    <tr>
                                       <td class=" text-center" > {{$value->name}}</td>
                                       <td class=" text-center"> {{$value->username}}</td>
                                       <td class=" text-center">  @if($value->email == "")Đang cập nhật @else{{$value->email}}@endif</td>
                                       <td class=" text-center">  @if($value->phone == "")Đang cập nhật @else{{$value->phone}}@endif</td>
                                       <td class=" text-center"> @if($value->address == "")Đang cập nhật @else{{$value->address}}@endif</td>
                                       <td class=" text-center"> {{$value->created_at}}</td>
                                   </tr>
                                @endif
                            @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
      <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
     <!-- end admin -->
</div>


