<div class="row il-history clearfix">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-1 col-md-8 col-md-offset-4 col-lg-6 col-lg-offset-3">
                <center><b><h2>Danh sách từ</h2></b></center>
                <br>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered word--break-word" id="tb_myWord">
                <thead>
                    <tr class="info" role="row">
                        <th class="text-center col--width2">Từ</th>
                        <th class="text-center col--width2">Nghĩa</th>
                        <th class="text-center col--width1">Loại từ </th>
                        <th class="text-center col--width3">Từ điển</th>
                        <th class="text-center col--width1">Thông báo</th>
                        <th class="text-center col--width1">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($getWordToUser))
                    @foreach($getWordToUser as $getWord)
                    <tr>
                        <th class="text-center col--width2 wordSetting"><?php echo htmlentities($getWord->word); ?></th>
                        <th class="text-center col--width2 meanSetting"><?php echo htmlentities($getWord->mean); ?></th>
                        <th class="text-center col--width2">{!! $getWord->type_word!!}</th>
                        <th class="text-center col--width2">{!! $getWord->lang_pair_name!!}</th>
                        @if($getWord->is_notification == 0)
                        <td class="text-center align--vertical-middle"><input type="checkbox" name="notification" class="cb_notification" data-id="{!! $getWord->id !!}"></td>
                        @else
                        <td class="text-center align--vertical-middle" ><input type="checkbox" name="notification" class="cb_notification" data-id="{!! $getWord->id !!}" checked></td>
                        @endif
                        <td class="text-center align--vertical-middle">
                            <span>
                                <a class="fa fa-trash-o fa-1x deleteWordHistory" data-toggle="tooltip" data-placement="left" title="Xóa!" data-id="{!! $getWord->id !!}"></a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
           {{ $getWordToUser->links() }}
        </div>
    </div>
</div>
