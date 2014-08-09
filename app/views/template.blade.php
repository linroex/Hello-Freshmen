<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="UTF-8">
    <title>Hello 新生！</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap-theme.min.css')}}">
    <script src="{{url('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <style>
        .panel-body{
            min-height:150px;
        }

    </style>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                    appId      : '859157527427936',
                    xfbml      : true,
                    version    : 'v2.0'
                });
                CheckLogin();
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        $(document).ready(function(){
            $('#add_form input:submit').click(function(e){
                e.preventDefault();
                addFreshmen();
            })
            $('#search_form input:submit').click(function(e){
                e.preventDefault();
                searchFreshmen();
            })
        })
    </script>
    <script>
        function CheckLogin(){
            FB.getLoginStatus(function(res){
                
                if(res.status == 'connected'){
                    $('#FbLoginBtn').hide();
                    console.log('login success');
                    LoadUserData();
                }else{
                    console.log('not login');
                }
            })
        }
        function LoadUserData(){
            FB.api('/me/picture','get',{type:'large'},function(res){
                $('#freshmen_img').attr('src',res.data.url);
            })
            FB.api('/me',function(res){
                $('#fi_name').text(res.name);
                $('#facebook_id').val(res.id);
            })
        }
        function addFreshmen(){
            $.post('add',$('#add_form').serialize(),function(res){
                if(res == 'ok'){
                    alert('新增成功');
                }else{
                    console.log(res);
                }
            });
        }
        function searchFreshmen(){
            $.post('search',$('#search_form').serialize(),function(res){
                if(res == 'ok'){
                    console.log(res);
                }else{
                    console.log(res);
                }
            });
        }
    </script>
</head>
<body>
    <div class="bs-docs-header">
        <div class="container">
            <h1>Hello 新生！</h1>
            <p>身為學長姊，迫不及待想找出你的學弟妹嘛？身為大一新鮮人，迫不及待想知道你的同學是誰嘛？別猶豫，我們將會是你最好的幫手！</p>
        </div>
    </div>
    <!-- bs-docs-header end -->

    <div class="container">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="panel-title">1. 選擇身分</p>
                </div>
                <div class="panel-body">
                    
                    <a href="" class="btn btn-default btn-block">我是舊生，我想找學弟妹</a>
                    <a href="" class="btn btn-default btn-block">我是新生，我想找同學</a>
                    <a href="" class="btn btn-default btn-block">我是新生，我想被同學找</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="panel-title">2. 選擇考試類型</p>
                </div>
                <div class="panel-body">
                    <a href="" class="btn btn-default btn-block">統測</a>
                    <a href="" class="btn btn-default btn-block">學測</a>
                    <a href="" class="btn btn-default btn-block">指考</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="panel-title">3. 輸入准考證號碼 </p>
                </div>
                <div class="panel-body">
                    <form action="">
                        <input type="text" placeholder="准考證號碼" class="form-control">
                        <br>
                        <input type="submit" value="查詢" class="btn-block btn-lg btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bs-docs-footer">
        <div class="container">
            程式設計：台科大林熙哲
        </div>
    </footer>

    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">搜尋結果</h4>
          </div>
          <div class="modal-body" id="search_result">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>
</html>