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
        var word = $('#txtSearch').val();
        var langPairName = $('#lagPair :selected').text();
        var langPairId = $('#lagPair :selected').val();
        var typeWord = $(this).prev().text();
        var mean = $(this).closest('ul').find('b').text();
        var _token = $('input[name=_token]').val();

        word = htmlEntities(word);
        mean = htmlEntities(mean);

        ajaxAddWordToMyWords(word, langPairName, langPairId, typeWord, mean, _token);
    });

    function ajaxAddWordToMyWords(word, langPairName, langPairId, typeWord, mean, _token){
        $.ajax({
            url:'myWord',
            method:'POST',
            dataType:'json',
            data: {'word': word,'langPairName': langPairName,'langPairId' : langPairId, 'typeWord' : typeWord, 'mean' : mean, '_token' : _token},
            success : function(response){
                if(response['data']==true){
                    $.notify('Đã thêm từ "'+word+'" với nghĩa "'+mean+'" vào Từ của tôi', "success");
                }
                else if (response['data'] == false)
                    $.notify('Từ "'+word+'" với nghĩa "'+mean+'" đã có');
            },
            error: function(xhr, error) {
             console.log(error);
            }
        });
    }


    //Get ID of table word_users
    $(document).on('click', '.cb_notification', function(){
        var id = $(this).attr('data-id'); //return value with its
        var word = $(this).closest('tr').find('.wordSetting').text();
        var mean = $(this).closest('tr').find('.meanSetting').text();
        var _token = $('input[name=_token]').val();
        if (this.checked){
            var is_notification = 1;
        }
        else{
            var is_notification = 0;
        }

        ajaxUpdateNotification(id, is_notification, word, mean, _token);
    });

    //Ajax notification update to word_users
    function ajaxUpdateNotification(id, is_notification, word, mean, _token)
    {
        $.ajax({

            url:'notification',
            method:'POST',
            dataType:'json',
            data: {'id': id,'is_notification': is_notification, 'word': word, 'mean': mean, '_token' : _token},
            success : function(response){
                if(response['data']==true){

                    $.notify('Đã thêm từ "'+word+'" với nghĩa "'+mean+'" vào thông báo', "success");
                }
                else if (response['data'] == false)
                    $.notify('Đã loại từ "'+word+'" với nghĩa "'+mean+'" ra khỏi thông báo');
            },
            error: function(xhr, error) {
             console.log(error);
            }
        });
    }

    // Delete word in my history
    $(document).on('click' , '.deleteWordHistory', function(){
        var id = $(this).attr('data-id');
        var _token = $('input[name=_token]').val();
        var word = $(this).closest('tr').find('.wordSetting').text();
        var mean = $(this).closest('tr').find('.meanSetting').text();
        var _this = $(this);

        $(this).confirmation({
          title: 'Xóa!',
          onConfirm: function() {
           deleteWordUserHistory(id, word, mean, _token, _this);
          },
          onCancel: function() {
          },
        });

        $(this).confirmation('show');
    });

    //Ajax delete Word user in my history
    function deleteWordUserHistory(id, word, mean, _token, _this)
    {
        $.ajax({
            url:'deleteWordHistory',
            method:'POST',
            dataType:'json',
            data:{'id': id, 'mean': mean, 'word': word, '_token': _token},
            success : function(response){
                if(response['data']==true){
                    // Delete rows
                    _this.closest('tr').remove();
                    $.notify('Đã xóa từ "'+word+'" với nghĩa "'+mean+'" ra khỏi lịch sử', "success");
                }
            },
            error: function(xhr, error) {
                console.log(error);
            }
        });
    }

    //ADD WORD FROM MY HISTORY
    $(document).on('click', '#btnAddHistory', function(){
        var typeWord = $("#typeWord").val();
        var fromText = $("#fromText").val();
        var toText = $("#toText").val();
        var langPairName = $('#lagPair :selected').text();
        var langPairId = $('#lagPair :selected').val();
        var _token = $('input[name=_token]').val();

        fromText = htmlEntities(fromText);
        toText = htmlEntities(toText);

        addWordUserFromMyHistory(typeWord, fromText, toText, langPairName, langPairId, _token);
    });

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    //Function ajax add word in my history on word_users
    function addWordUserFromMyHistory(typeWord, fromText, toText, langPairName, langPairId, _token)
    {
        $.ajax({
            url:'addWordMyHistory',
            method: 'POST',
            data : {'typeWord': typeWord,'fromText': fromText,'toText': toText,'langPairName': langPairName,'langPairId': langPairId, '_token' : _token},
            dataType:'json',
            success : function(response){
                if(response["data"]== true){
                    // Create new row
                    var id = response["id"];
                    var rowAdd = getRowAddHistory(fromText, toText, typeWord, langPairName, id);
                    $(document).find("#tb_myWord").append( rowAdd );
                    $.notify('Đã thêm từ "'+fromText+'" với nghĩa "'+toText+'" vào lịch sử!', "success");
                }
                else if(response["data"]== false){
                    $.notify('Từ "'+ fromText +'" với nghĩa "'+ toText +'" đã có!', "warn");
                }
                // else if(response["data"]== 'invalidate'){
                //     $.notify('Từ không hợp lệ!', "warn");
                // }
                else if(response["data"]== 'emptyFrom'){
                    $.notify('Bạn chưa nhập từ!', "warn");
                }
                else if(response["data"]== 'emptyTo'){
                    $.notify('Bạn chưa nhập nghĩa!', "warn");
                }
            },
            error: function(xhr, error) {
                $.notify("Oppps: Lỗi, vui lòng thử lại", "warn");
            }
        });
    }

    //Create table to save value when user add word
    function getRowAddHistory(fromText, toText, typeWord, langPairName, id){
        return '<tr>'+
                    '<th class="text-center col--width2 wordSetting">'+fromText+'</th>'+
                    '<th class="text-center col--width2 meanSetting">'+toText+'</th>'+
                    '<th class="text-center col--width2">'+typeWord+'</th>'+
                    '<th class="text-center col--width2">'+langPairName+'</th>'+
                    '<td class="text-center align--vertical-middle">'+
                        '<input type="checkbox" name="notification" class="cb_notification" data-id="'+id+'">'+
                    '</td>'+
                    '<td class="text-center align--vertical-middle">'+
                        '<span>'+
                            '<a class="fa fa-trash-o fa-1x deleteWordHistory" data-toggle="tooltip" data-placement="left" title="Xóa!" data-id="'+id+'"></a>'+
                        '</span>'+
                    '</td>'+
                '</tr>';
    }

    // SCREEN NOTIFICATION
    // Toggle button
    $(document).find('#toggle-one').bootstrapToggle();

    //Save data of notification on setting_users
    $(document).on('click', '#_save-setting', function(){
        if($('#toggle-one').prop('checked')){
            var notificationButton = "ON";
        }
        else {
            var notificationButton = "OFF";
        }
        var timeReminder = $('#_time').val();
        var typeReminder = $('#_typeRemind').val();
        var _token = $('input[name=_token]').val();

        ajaxGetInfoNotification(notificationButton, timeReminder, typeReminder, _token);
    });

    //ajax get information of notification
    function ajaxGetInfoNotification(notificationButton, timeReminder, typeReminder, _token){
        $.ajax({
            url: 'addInfoNotificate',
            method: 'POST',
            data: {'notificationButton': notificationButton, 'timeReminder': timeReminder, 'typeReminder': typeReminder, '_token': _token},
            dataType: 'json',
            success : function(response){
                if(response["data"]== true){
                    $.notify('Cài đặt thành công!', "success");
                }
            },
            error: function(xhr, error) {
                $.notify("Oppps: Lỗi, vui lòng thử lại", "warn");
            }
        });
    }
});
