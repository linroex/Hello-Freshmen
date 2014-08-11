<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="UTF-8">
    <title>Hello 新生！</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap-theme.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{url('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <style>
        .panel-body{
            min-height:150px;
        }

    </style>
    <script src="{{url('js/custom.js')}}"></script>
</head>
<body>
    <div class="bs-docs-header">
        <div class="container">
            <h1>Hello 新生！ <p style="font-size:17px;" class="label label-primary">現在記錄數：{{{$count}}}人</p></h1>
            <p>每到榜單公布，總是迫不及待的想加學弟妹Facebook卻查不到嘛？身為新生，想要先認識自己學長姊，了解學校的相關事務卻不知道找誰嘛？或是想認識新同學，但榜單上的名字拿去搜尋Facebook，卻半個同學也找不到？</p>
            
        </div>
    </div>
    <!-- bs-docs-header end -->

    <div class="container">
        <div class="lead">
            <p>「Hello 新生」希望可以解決這個問題，作為新生與舊生的媒婆，新生可以在這裡將臉書帳號和准考證號碼進行綁定，而舊生則可以直接輸入准考證號碼找到新生的Facebook，每行可以輸入一個准考證號碼。這不是魔術，這一切的媒和成功，來自於我們資料庫中的記錄數量，所以請不要猶豫，趕快把這個網站分享給你的朋友吧！</p>
            <div class="fb-like" data-href="{{url()}}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>

        <div class="row text-center" id="login_block">
            <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false">第一步，登入Facebook！</div>
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
            <a href="https://www.facebook.com/groups/657228561002804/">台科大程式設計研究社</a> 製作
        </div>
    </footer>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-4977677-13', 'auto');
      ga('send', 'pageview');

    </script>

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