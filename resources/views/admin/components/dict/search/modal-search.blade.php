<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
            @if(isset($code))
              {!! $lastKey !!}
            @endif
          </h4>
        </div>
        <div class="modal-body">
          <form method="post" id="_form-update-word">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>Nghĩa</label>
            <span class="{{ $errors->has('_nghia') ? ' has-error' : '' }}">
              <input type="text" class="form-control" id="_mean" name="_nghia" required maxlength="50">
              @if($errors->has('_nghia'))
                  <div>
                      <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('_nghia') !!}</strong></p>
                  </div>
              @endif
            </span>
            <br>
            <label>Giải thích</label>
            <span class="{{ $errors->has('_gtTo') ? ' has-error' : '' }}">
              <textarea class="form-control" id="_gtTo" name="_gtTo"></textarea>
              <script type="text/javascript">CKEDITOR.replace( '_gtTo',{
                enterMode: Number(2),
              }); </script>
              @if($errors->has('_gtTo'))
                  <div>
                      <p class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>{!! $errors->first('_gtTo') !!}</strong></p>
                  </div>
              @endif
            </span>
            <br>
            <input type="hidden" class="form-control" id="_table-modal" name="_table_modal">
            <input type="hidden" class="form-control" id="_id-word-modal" name="_id_word_modal">
            <input class="btn btn-info" type="submit" value="Cập nhật" id="_btn-update">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
