<!DOCTYPE HTML>
<html>
<head>
    <title>Purple_loginform Website Template | Home :: w3layouts</title>
    <link href="{{asset('errorIcj/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- -->
    <script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
    <script src="{{asset('errorIcj/js/jquery.min.js')}}"></script>
    <script>$(document).ready(function(c) {
            $('.alert-close').on('click', function(c){
                $('.message').fadeOut('slow', function(c){
                    $('.message').remove();
                });
            });
        });
    </script>
</head>
<body>
<!-- contact-form -->
<div class="message warning">
    <div class="inset">
        <div class="login-head">
            <h1>404-网页出错啦！</h1>
            <div class="alert-close"> </div>
        </div>
        <form>

            <div class="clear"> </div>
            <div>
                <h2>对不起，您访问的页面丢失了，我们会很快将他找回。</h2><br/><br/>
                <a href="{{url('Admin/Index/main')}}"><<<返回首页</a>
                <div class="clear">  </div>
            </div>
        </form>
    </div>
</div>
</div>
<div class="clear"> </div>
<!--- footer --->
<div class="footer">
    <p>Copyright &copy; 404.life</p>
</div>

</body>
</html>
