$(document).ready(function(){
    // TRANSLATE PARAGRAPH
    $(document).on('click', '#btn_translate', function(evt){
        var lang_from = $('#lang_from').val();
        var lang_to = $('#lang_to').val();
        var paragraph_from = $('#paragraph_from').val();
        var _token = $('input[name=_token]').val();

        ajaxTranslateParagraph(lang_from, lang_to, paragraph_from, _token);
    });

    function ajaxTranslateParagraph(lang_from, lang_to, paragraph_from, _token){
        $.ajax({
            url:'translate-paragraph',
            method: 'get',
            data : {'lang_from': lang_from, 'lang_to': lang_to, 'paragraph_from': paragraph_from, '_token': _token},
            dataType:'json',
            success : function(response){
                var code = response['code'];
                var data = response['data'];
                if(code == true){
                    var task1 = '<div class="paragraph_to"><span>Kết quả</span><textarea rows="10" class="col-md-12 col-xs-12 col-sm-12">'+data+'</textarea></div>';
                    var task2 = '<div class="error_translate"></div>';

                    $(document).find('.paragraph_to').replaceWith( task1 );
                    $(document).find('.error_translate').replaceWith( task2 );
                }
                else{
                    if(data == "empty"){
                        var error = 'Bạn chưa nhập nội dung!';
                    }
                    // data = "maxLength"
                    else{
                        var error = 'Nội dung tối đa 2000 kí tự!';
                    }
                    var task1 = '<div class="error_translate"><div class="has-error"><b class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>   <strong>'+error+'</strong></b></div></div>';
                    var task2 = '<div class="paragraph_to"></div>';

                    $(document).find('.error_translate').replaceWith( task1 );
                    $(document).find('.paragraph_to').replaceWith( task2 );
                }
                $("textarea").height( $("textarea")[0].scrollHeight );
            },
        });
    }

    $(document).find('._tooltip-me').tooltip();

    // ADD WORDS TO MY WORDS
    $(document).on('click','._push-his', function(evt){
        alert('ok');
    });
});
