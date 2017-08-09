
$(document).ready(function() {
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
        var mean = _element.find('._mean').text();
        var pronoun = _element.find('._pronoun').text();

        $('#_mean').val(mean);
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
/*Fillter*/
    $(document).on('change','.cbselect', function()
    {
      var value = $(this).val();
      var _token = $('input[name=_token]').val();
      $.ajax(
      {
        url: 'fillter',
        type: 'POST',
        data: {'value' : value, '_token':_token},
        beforeSend:function()
        {
          $('#example_wrapper').html('Đang tải dữ liệu !');
        },
        success:function(data){
          $('#example_wrapper').html(data);
        },
      });
    });
/*Search word by type*/
  $(document).on('change','#_typeWord',function(){
    var textSearch = $('#textSearch').val();
    var value = $(this).val();
    var _token = $('input[name=_token]').val();
    $.ajax(
    {
      url : 'seachWord',
      type : 'POST',
      data : {'value' : value, '_token' :_token,'text' : textSearch},
      beforeSend:function()
      {
        $("#example_wrapper").html('Đang tải dữ liệu');
      },
      success:function(data){
         $("#example_wrapper").html(data);
      }
    });
  });
  /*Search word by Language*/
   $(document).on('change','#_lang',function(){
    var textSearch = $('#textSearch').val();
    var type = $('#_typeWord').val();
    var _token = $('input[name=_token]').val();
    var lang = $(this).val();
    $.ajax(
    {
      url : 'seachWordByLang',
      type : 'POST',
      data : {'type' : type, '_token' :_token,'text' : textSearch,'lang': lang},
      beforeSend:function()
      {
        $("#example_wrapper").html('Đang tải dữ liệu');
      },
      success:function(data){
         $("#example_wrapper").html(data);
      }
    });
  });
   /*Add wword after collecting*/
   $(document).on('click','#_waitting',function(){
      var _element = $(this).closest('tr');
      var word = _element.find('._tdWord').text();
      var mean = _element.find('._tdMean').text();
      var lang = _element.find('._tdLang').attr('data-id');
      var type = _element.find('._tdType').text();
      var _token = $('input[name=_token]').val();
      if (lang== 1) {
        toLg = 3;             
        } else{
        toLg = 1;
        }
      $(this).confirmation({
           title: 'Bạn có muốn thêm từ này vào từ điển ?',
            onConfirm: function() {
           if(word == mean ){
            $.notify("Từ với nghĩa không được giống nhau","warn");
              }
              else{
            ajaxAddWord(word,mean,lang,type,_element,_token);
          }
            },
            onCancel: function() {
            },
       });
       $(this).confirmation('show');
   });
    /* =============================================*/
    function ajaxAddWord(word,mean,lang,type,_element,_token){
      $.ajax({
        url: 'addword',
        method: 'POST',
        data : {'fromText' : word, 'toText' : mean, 'fromLg' : lang,'toLg' : toLg,'typeWord' : type, '_token' : _token},
        beforeSend:function()
        {
            $('#_waitting').addClass('loading');

        },
        success:function(data){
          $.notify('Đã thêm thành công từ ' + word + ' và nghĩa '+mean+' vào hệ thống',"success");
        },
      });
    }

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
                   $.notify("Xóa thành công ra khỏi hệ thống!", "success");
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
                $.notify("Cập nhật quyền cho '" +userName+ "' thành công","success");
              }else{
                $.notify("Bạn không thể sửa đổi quyền, vui lòng thử lại !","warn");
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
                $.notify("Bạn không thể sửa đổi tình trạng của User, vui lòng thử lại !","warn");
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
                $.notify( "Bạn không thể xóa user !","warn");
              }
            },
            error: function(xhr, error) {
               console.log(error);
            }
      });
    }
    /*Login sussess*/

    /*Pop hover*/
    $('[data-toggle="popover"]').popover();
    // datePiker
    $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
});

