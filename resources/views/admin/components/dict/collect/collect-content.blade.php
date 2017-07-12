    <div class="panel">
        <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <form class="form-inline margin--top-none" action="{{ route('adminDictCollectByCondition') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="input-group ">
                        <span class="input-group-addon">Tình trạng</span>
                        <select class="form-control" name="_condition">
                            @foreach($listSearch as $value)
                            <option
                                @if($value == $cbTypeWord)
                                    {!! "selected" !!}
                                @endif
                            >{!! $value !!}</option>
                            @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-info">
                          <span class="glyphicon glyphicon-search"></span>
                      </button>
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
                            @foreach($submitions as $row)
                            <tr role="row" class="odd text-center">
                                <td>{{ $row->STT }}</td>
                                <td class='_edit-me'>{!! $row->from_text !!}</td>
                                <td class='_edit-me'>{!! $row->to_text !!}</td>
                                <td>{!! $row->from !!}-{!! $row->to !!}</td>
                                <td>{!! $row->quanlity !!}</td>
                                <td>{!! $row->type_from !!}</td>
                                <td>{!! $row->status !!}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng cộng có {!! $noOfSubmitions !!} kết quả
                        </div>
                    </div>
                    <div class="col-sm-7">
                    </div>
                </div>
            </div>
            <!-- /.Table -->
        {!! $submitions->links() !!}
        </div>
    </div>
