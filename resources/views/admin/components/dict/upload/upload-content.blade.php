    <div class="panel">
        <div class="panel-body">
            {!! Form::open(array('enctype' => 'multipart/form-data', 'files' =>true, 'accept-charset' => 'utf-8')) !!}
            <div class="panel-content">
                {!! Form::label('csvFile', 'Tải lên file csv') !!}
                {!! Form::file('csvFile', ['class' => 'btn btn-default']) !!}
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
            {!! Form::submit('Duyệt file', ['class' => 'btn btn-default']) !!}
        </div>
        {!! Form::close() !!}
    </div>
