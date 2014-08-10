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
            $('#data_form input:submit').click(function(e){
                e.preventDefault();
                if($('#identity').val() == '' || $('#exam_type').val() == ''){
                    alert('請選擇身分或考試類型');
                    return;
                }
                if($('#identity').val() == 0){
                    addFreshmen();
                }else{
                    searchFreshmen();
                }
            })
            
            $('.btn-option').click(function(e){
                e.preventDefault();
                $(this).addClass('btn-primary');
                $('.panel-body').has(this).children('.btn').not(this).removeClass('btn-primary');
            })
            $('#identity_block .btn').click(function(){
                $('#identity').val($(this).attr('value'));
                switch($(this).attr('value')){
                    case '0':
                        $('#ticket_input').after('<input type="text" id="ticket_input" name="ticket" placeholder="准考證號碼" class="form-control">')
                        $('#ticket_input').remove();
                        $('input:submit').val('登記');
                        break;
                    case '1':
                        $('#ticket_input').after('<textarea class="form-control" rows="5" name="ticket" id="ticket_input"></textarea>')
                        $('#ticket_input').remove();
                        $('input:submit').val('查詢');
                        break;
                    case '2':
                        $('#ticket_input').after('<textarea class="form-control" rows="5" name="ticket" id="ticket_input"></textarea>')
                        $('#ticket_input').remove();
                        $('input:submit').val('查詢');
                        break;

                }
            })
            $('#exam_type_block .btn').click(function(){
                $('#exam_type').val($(this).attr('value'));
            })
        })
    </script>
    <script>
        function CheckLogin(){
            FB.getLoginStatus(function(res){
                
                if(res.status == 'connected'){
                    $('#login_block').hide();
                    $('#main_block').css('display','block');

                    console.log('login success');
                    LoadUserData();
                }else{
                    console.log('not login');
                }
            })
        }
        function LoadUserData(){
            FB.api('/me',function(res){
                $('#facebook').val(res.id);
            })
        }
        function showModal(title,body){
            $('#myModal .modal-title').text(title)
            $('#myModal .modal-body').html(body)
            $('#myModal').modal();
        }
        function addFreshmen(){
            $.post('add',$('#data_form').serialize(),function(res){
                if(res == 'ok'){
                    var str = "您的資料已經新增成功<br />接下來，什麼也不用做，靜靜等候你的學長姊、同學來找你吧！"
                    showModal('新增成功', str);
                }else{
                    showModal('新增失敗', res.join("<br/>"));
                }
                $('#data_form input:text').val('');
            });
        }
        function searchFreshmen(){
            $.post('search',$('#data_form').serialize(),function(res){
                res = JSON.parse(res);
                var ticket = $('#ticket_input').val().split("\n");
                console.log(ticket);
                if(res.status == 'success'){
                    var str = "<p>查詢結果如下：</p>";
                    $.each(res.data, function(i){
                        if(res.data[i] == 'null'){
                            str += "准考證號碼：" + ticket[i] + " 查無此人<br />";
                        }else{
                            var img = '';
                            FB.api(res.data[i] + '/picture','get',{type:'large'},function(resp){
                                FB.api(res.data[i],function(user_data){
                                    str = '<div class="col-md-3"><a target="_blank" href="https://www.facebook.com/' + res.data[i] + '"><img src="' + resp.data.url + '" class="col-md-12 img-rounded" alt="" /></a><br /> <p class="text-center">' + user_data.name + '</p> </div>';

                                    var origin = $('#myModal .modal-body').html();
                                    $('#myModal .modal-body').html(origin + str);
                                })
                            });
                        }
                    })
                    showModal('查詢成功', str);
                }else if(res.status == 'error'){
                    showModal('查詢失敗', res.data.join("<br/>"));
                }
                $('#data_form textarea').text('');
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
        <div class="row text-center" id="login_block">
            <div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="true" data-auto-logout-link="false"></div>
        </div>
        
        <div class="row" style="display:none;" id="main_block">
            <div class="col-md-4" id="identity_block">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title">1. 選擇身分</p>
                    </div>
                    <div class="panel-body">
                        <a value="0" href="" class="btn-option btn btn-default btn-block">我是新生，我想被同學找</a>
                        <a value="1" href="" class="btn-option btn btn-default btn-block">我是舊生，我想找學弟妹</a>
                        <a value="2" href="" class="btn-option btn btn-default btn-block">我是新生，我想找同學</a>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="exam_type_block">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title">2. 選擇考試類型</p>
                    </div>
                    <div class="panel-body">
                        <a value="JCEE" href="" class="btn-option btn btn-default btn-block">統測</a>
                        <a value="GCAT" href="" class="btn-option btn btn-default btn-block">學測</a>
                        <a value="AST" href="" class="btn-option btn btn-default btn-block">指考</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title">3. 輸入准考證號碼 </p>
                    </div>
                    <div class="panel-body">
                        <form action="{{url('search')}}" method="post" id="data_form">
                            <input type="hidden" name="facebook" id="facebook">
                            <input type="hidden" name="exam_type" id="exam_type">
                            <input type="hidden" name="identity" id="identity">
                            <input type="text" id="ticket_input" name="ticket" placeholder="准考證號碼" class="form-control">
                            <br>
                            <input type="submit" value="登記" class="btn-block btn-lg btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bs-docs-footer">
        <div class="container">
            程式設計：台科大林熙哲
        </div>
    </footer>

    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">搜尋結果</h4>
          </div>
          <div class="modal-body" id="search_result">
            
          </div>
          <div class="clearfix"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>
</html>