
$(document).ready(function() {
  	$(document).on('change','#_typeWord', function(evt){
  		var typeWord = $("#_typeWord :selected").val();
  		var _token = $('input[name=_token]').val();
          $.ajax ({
              url: 'adminSearch',
              type: 'POST',
              dataType: 'json',
              data :{'typeWord':typeWord,'_token' : _token},

              success: function(evt ){
                      location.reload();
                  }
       	});
    });

    $(document).on('click','.delete_', function(evt){
        var _element = $(this).closest('tr');
        var idWord = _element.find('._word-id').attr('data-id');
        var _token = $('input[name=_token]').val();
        var word = _element.find('._word').text();

        $(this).confirmation({
        	  title: 'Bạn có muốn xóa từ này?',
              onConfirm: function() {
              ajaxDeleteWord(_element, idWord, _token,word);
              },
              onCancel: function() {
              },
         });
         $(this).confirmation('show');
    });

    $(document).on('click','._update-word', function(evt){
        var _element = $(this).closest('tr');
        var idWord = _element.find('._word-id').attr('data-id');
        var word = _element.find('._word').text();
        var pronoun = _element.find('._pronoun').text();

        $('#_mean').val(word);
        $('#_pronoun').val(pronoun);
        $('#_id-word-modal').val(idWord);
    });

    // Update row word
    $(document).on('submit','#_form-update-word', function(evt){
        evt.preventDefault();
        if($('#_mean').val() != ''){
          var idWord = $('#_id-word-modal').val();
          var updateWord = $('#_mean').val();
          var updatePronoun = $('#_pronoun').val();
          var _token = $('input[name=_token]').val();
          ajaxUpdateWord(idWord, updateWord, updatePronoun, _token);
        }
    });

    // change role
    $(document).on('change','#selRole',function(evt){
      var _element = $(this).closest('tr');
      var idRole = $(this).val();
      var _token = $('input[name=_token]').val();
      var id = _element.find('._user-id').text();
      var userName = _element.find('._user-name').text();

      ajaxChangeRole(id,idRole, _token, userName);
    });

      $(document).on('click','.delete',function(evt){
        var _element = $(this).closest('tr');
        var _token = $('input[name=_token]').val();
        var id = _element.find('._user-id').text();
        $(this).confirmation({
            title: 'Bạn có muốn xóa user?',
              onConfirm: function() {
              ajaxDeleteUser(id,_element,_token);
              },
              onCancel: function() {
              },
         });
         $(this).confirmation('show');
      });
    // chang status
    $(document).on('change','#sel1',function(evt){
      var _element = $(this).closest('tr');
      var Status = $(this).val();
      var _token = $('input[name=_token]').val();
      var id = _element.find('._user-id').text();

       ajaxChangeStatus(id,Status, _token);
    });

    // DeleteWord
    function ajaxDeleteWord(_element, idWord, _token, word){
        $.ajax({
            url:'delete',
            method: 'POST',
            data : {'idWord': idWord, '_token' : _token},
            dataType:'json',
            success : function(response){
                if(response['data'] == true){
                   _element.remove();
                   $.notify("Xóa thành công từ ' "+word+"' ra khỏi hệ thống!", "success");
                }else{
                  s.notify("vui lòng thử lại","warn");
                }
            },
            error: function(xhr, error) {
               console.log(error);
            }
        });
    }

    function ajaxUpdateWord(idWord, updateWord, updatePronoun, _token){
        $.ajax({
            url:'update',
            method: 'POST',
            data : {'idWord': idWord, 'updateWord': updateWord, 'updatePronoun': updatePronoun,'_token' : _token},
            dataType:'json',
            success : function(response){
	            if(response['data']==true){
	              $('#myModal').modal('hide');
	              $('#modal-success').modal('show');
		        }
            },
            error: function(xhr, error) {
               console.log(error);
            }
        });
    }

    function ajaxChangeRole(id,idRole, _token, userName){
      $.ajax({
            url:'role',
            method: 'POST',
            data : {'idUser': id,'idRole':idRole, '_token':_token, 'username' :userName},
            dataType:'json',
            success : function(response){
              if(response['data']==true){
                $.notify("Cập nhật quyền cho user thành công","success");

              }
            },
            error: function(xhr, error) {
               console.log(error);
            }
        });
    }
    function ajaxChangeStatus(id,Status, _token){
      $.ajax({
            url:'status',
            method: 'POST',
            data : {'idUser'  : id,'status':Status, '_token':_token},
            dataType:'json',
            success : function(response){
              if(response['data']==true){
                 $.notify("Cập nhật trạng thái thành công","success");

              }else{
                $.notify("Bạn không thể khóa chính bạn","warn");
              }
            },
            error: function(xhr, error) {
               console.log(error);
            }
      });
    }

    function ajaxDeleteUser(id,_element,_token){
      $.ajax({
            url:'deleteUser',
            method: 'POST',
            data : {'idUser': id,'_token':_token},
            dataType:'json',
            success : function(response){
              if(response['data']==true){
                _element.remove();
               $.notify("Bạn đã xóa thành công","success");

              }
              else{
                $.notify( "Bạn không thể xóa chính bạn","warn");
              }
            },
            error: function(xhr, error) {
               console.log(error);
            }
      });
    }
    /*Pop hover*/
    $('[data-toggle="popover"]').popover();  
});

$(document).ready(function(){
    $(document).on('submit', '#form_upload', function(evt){
        $('.btn_upload').prop('disabled', true);

        //var alertWaiting = '<div><b><span class="glyphicon glyphicon-warning-sign"></span> Quá trình upload đang diễn ra, xin bạn vui lòng đợi trong giây lát...</b></div>'
        var alertWaiting = '<div class="loader"></div>';
        $('.alert_waiting').replaceWith(alertWaiting);

        return true;
    });
});

