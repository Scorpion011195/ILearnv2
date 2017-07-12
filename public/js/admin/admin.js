// Li tag active when focus this mouse
$('li a').focus(function(){
  $(this).closest('li').addClass('active');
});

$('li a').blur(function(){
  $(this).closest('li').removeClass('active');
});
// End LI tag