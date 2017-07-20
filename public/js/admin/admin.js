// Li tag active when focus this mouse
$('li a').focus(function(){
  $(this).closest('li').addClass('active');
});

$('li a').blur(function(){
  $(this).closest('li').removeClass('active');
});

// End LI tag
/*TiNyMCE*/
$(document).ready(function(){
    $(document).on('submit', '#form_upload', function(evt){
        $('.btn_upload').prop('disabled', true);
        return true;
    });
});
