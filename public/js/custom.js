function CheckLogin(){
    FB.getLoginStatus(function(res){
        
        if(res.status == 'connected'){
            $('#login_block').hide();
            $('#main_block').css('display','block');

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

window.fbAsyncInit = function() {
    FB.init({
            appId      : '639222002851918',
            xfbml      : true,
            version    : 'v2.0'
        });
        CheckLogin();
        FB.Event.subscribe('auth.statusChange', CheckLogin);
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