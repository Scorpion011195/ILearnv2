    <div class="panel">
        <div class="panel-body">
            {!! Form::open(array('enctype' => 'multipart/form-data', 'files' =>true, 'accept-charset' => 'utf-8')) !!}
            <div class="panel-content">
            <div class="col-sm-8">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label">Upload File</label>
                        <input id="" type="file" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Ngôn ngữ</label>
                       <select name="" class="form-control">
                           <option value="">Anh - Việt</option>
                           <option value="">Việt- Nhật</option>
                           <option value="">Anh - Nhật</option>
                       </select>
                    </div>
                </div>
            </div>
            </div>
            @if ($errors->any())
                <div>
                    <p class="alert--fail" id="_notify"><span class="glyphicon glyphicon-warning-sign"></span>
                        @foreach ($errors->all() as $error)
                            {!! $error !!}
                        @endforeach
                    </p>
                </div>
            @endif
            @if(isset($info))
                <div>
                    <p class="alert--success" id="_notify"><span class="glyphicon glyphicon-warning-sign"></span>Thêm file thành công!
                    </p>
                </div>
            @endif
        </div>
        <div class="panel-footer">
          <input type="submit" class=" btn btn-success" value="Tải lên" >
        </div>
        {!! Form::close() !!}

        

    </div>
