<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
            <b>Chỉnh sửa từ</b>
          </h4>
        </div>
        <div class="modal-body">
          <form method="post" id="_form-update-word">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>Từ</label>
            <span class="{{ $errors->has('_nghia') ? ' has-error' : '' }}">
              <input type="text" class="form-control" id="_mean" name="_nghia" value="" required maxlength="50">
            </span>
            <br>
            <label>Phát âm</label>
            <span class="{{ $errors->has('_nghia') ? ' has-error' : '' }}">
              <input type="text" class="form-control" id="_pronoun" name="_pronoun" required maxlength="50">
            </span>
            <br>
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
