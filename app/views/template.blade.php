<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello 學弟妹！</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap-theme.min.css')}}">
    <script src="{{url('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <style>
        .step-num{
            font-size:110%;
        }
    </style>
</head>
<body>
    <div class="bs-docs-header">
        <div class="container">
            <h1>Hello 學弟妹！</h1>
            <p>身為學長姊，迫不及待想找出你的學弟妹嘛？身為大一新鮮人，迫不及待想知道你的同學是誰嘛？別猶豫，我們將會是你最好的幫手！</p>
        </div>
    </div>
    <!-- bs-docs-header end -->

    <div class="container">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>我是學長姊</h4>
                </div>
                <div class="panel-body">
                    <p class="step-num label label-primary">1. 選擇考試類型</p>
                    <p></p>
                    <select name="" id="" class="form-control">
                        <option value="">統測</option>
                        <option value="">學測</option>
                        <option value="">指考</option>
                    </select>
                    <hr>

                    <p class="step-num label label-primary">2. 輸入准考證號碼</p>
                    <p></p>
                    <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
                    <hr>

                    <input type="submit" value="查詢" class="btn btn-primary btn-block">
                </div>
                

            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>我是學弟妹</h4>
                </div>
                <div class="panel-body">
                    <p class="step-num label label-success">1. 登入Facebook</p>
                    <p></p>
                    <hr>   
                    
                    <p class="step-num label label-success">2. 選擇考試類型</p>
                    <p></p>
                    <select name="" id="" class="form-control">
                        <option value="">統測</option>
                        <option value="">學測</option>
                        <option value="">指考</option>
                    </select>
                    <hr>
                    
                    <p class="step-num label label-success">3. 輸入准考證號碼</p>
                    <p></p>
                    <input type="text" name="" id="" class="form-control">
                    <hr>
                    
                    <input type="submit" value="登記" class="btn btn-success btn-block">
                </div>
            </div>
        </div>
    </div>

    <footer class="bs-docs-footer">
        <div class="container">
            程式設計：台科大林熙哲
        </div>
    </footer>
</body>
</html>