
$(document).ready(function() {
	$(document).on('change','#_typeWord', function(evt){
		var typeWord = $("#_typeWord :selected").val();
		var _token = $('input[name=_token]').val();
        $.ajax ({
            url: 'adminSearch',
            type: 'POST',
            dataType: 'json',
            data :{'typeWord':typeWord,'_token' : _token},

            success: function(html){
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
    // datePicker
    function ajaxDeleteWord(_element, idWord, _token, word){
        $.ajax({
            url:'delete',
            method: 'POST',
            data : {'idWord': idWord, '_token' : _token},
            dataType:'json',
            success : function(response){
                if(response['data'] == true){
                   _element.remove();
                   $.notify("Xóa thành công !", "success");
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
});

// End LI tag
/*TiNyMCE*/
$(document).ready(function(){
    $(document).on('submit', '#form_upload', function(evt){
        $('.btn_upload').prop('disabled', true);
        return true;
    });
});
