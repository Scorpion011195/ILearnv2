<div class="panel">
    <form action="{{ route('adminPostUpload') }}" method="post" enctype="multipart/form-data" id="form_upload">
        <div class="panel-body">
            <div class="panel-content">
                <div class="col-sm-8">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Danh sách từ muốn thêm</label>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="file" name="fileWordsUpload" class="form-control">
                        </div>
                        @if ($errors->any())
                            <div>
                                <b class="
                                @if($errors->has('errorSuccess'))
                                    has--success
                                @else
                                    has--error
                                @endif
                                " id="_notify"><span class="glyphicon glyphicon-warning-sign"></span>
                                    @foreach ($errors->all() as $error)
                                        {!! $error !!}
                                    @endforeach
                                </b>
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Ngôn ngữ</label>
                            <select name="codeLanguageVdict" class="form-control">
                               @foreach($codeLanguageVdict as $key=>$value)
                                   <option value="{{ $value }}"
                                   @if($value == old('codeLanguageVdict'))
                                       selected
                                   @endif
                                   >{{ $key }}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="margin--left-30px">
                <input type="submit" class="btn btn-success btn_upload" value="Tải lên">
            </div>
        </div>
    </form>
</div>
