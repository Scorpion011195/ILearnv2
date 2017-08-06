<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '481674922185679',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script src="{!! asset('js/bootstrap-confirmation.js') !!}"></script>
<script src="{!! asset('js/notify.js') !!}"></script>
<script src="{!! asset('js/bootstrap-datepicker.min.js') !!}"></script>
<script type="text/javascript" src="{{ asset('js/slide.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/user/user.js')}}"></script>
