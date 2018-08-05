<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{ env('TITLE') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/static/css/bootstrap.min.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/css/demo.css') }}">

    <!--弹幕-->
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/static/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/dist/css/barrager.css') }}">

    <!--颜色-->
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/static/pick-a-color/css/pick-a-color-1.2.3.min.css') }}">

    <!--弹出框-->
    <link rel="stylesheet" type="text/css" href="{{ asset('annie/css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('annie/css/demo.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('annie/css/dialog.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('annie/css/dialog-annie.css') }}" scoped/>
    <script type="text/javascript" src="{{ asset('annie/js/modernizr.custom.js') }}"></script>


</head>
<style >
    *{
        margin: 0;
        padding: 0;
        list-style-type:none;
    }
    a,img{
        border:0;
    }
    #myLeft{
        width: 100%;
        height: 100%;
    }
    #myRight{
        position: absolute;
        width: 100%;
        height: 100%;
        transform: rotate(180deg);
        top: 0;
    }
    .clearboth:after{
        content: "";
        clear: both;
        display: block;
    }
    .send {
        width: 100%;
        height: 76px;
        position: absolute;
        bottom: 0;
        left: 0;
    }
    .send .s_fiter{
        width: 100%;
        height: 76px;
        background: #000;
        left: 0;
        opacity: 0.8;
    }
    .send .s_con{
        width: 100%;
        height: 76px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
        line-height: 76px;
    }
    .send .s_con .s_txt{
        width: 69%;
        height: 36px;
        border-radius: 4px 0 0 4px;
        outline: none;
        border: 1px solid;
        margin-top: 20px;
        color: black;
    }
    .send .s_con .s_sub{
        width: 30%;
        height: 37px;
        background: red;
        outline: none;
        font-size: 14px;
        color: #fff;
        font-family: "微软雅黑";
        border-radius: 0 4px 4px 0;
        border: 1px solid red;
        margin-top: 20px;
    }
    .myInput{
        width: 100%;
        float: left;
        position: relative;
    }
    .mySend{
        width: 100%;
        position: absolute;
        top: -55%;
        left: 0%;
    }
    .option{
        width: 100%;
        font-size: 25px;
        font-weight: bold;
        text-align: center;
    }
    .square{
        background-color: rgba(245,108,108,0.5);
    }
    .negative{
        background-color: rgba(22,142,245,0.5);
    }
    .add{
        width: 200px;
        margin: 0 auto;
        margin-top: 50px;
        display: block;
        border-radius: 10%;
    }
</style>


<body>
<div style="position: relative;width: 100%;height: 100px">
    <div id="myLeft"></div>
    <div id="myRight"></div>
</div>

<div class="clearboth">
    <div style="float: left;width: 50%;text-align: center;">
        <span id="zhengfang" class="option" style="color: rgb(245,108,108)">正:</span>
    </div>
    <div style="float: right;width: 50%;text-align: center;">
        <span id="fanfang" class="option" style="color: rgb(22,142,245);">反:</span>
    </div>
</div>

<div>
    <button class="square add">加入正方阵营</button>
    <button class="negative add">加入反方阵营</button>
</div>

<div class="send">
    <div class="s_fiter">
        <div class="s_con">
            <input type="text" style="margin-left: 2px" class="s_txt myInput" id="input">
            <button value="发布评论" class="s_sub myInput">
                <span class="mySend" data-dialog="somedialog">发弹幕</span>
            </button>
        </div>
    </div>
</div>

<div id="somedialog" class="dialog">
    <div class="dialog__overlay"></div>
    <div class="dialog__content">
        <h2><strong id="toast_warn">警告</strong><p id="toast_text">testtest</p></h2><div><button class="action" data-dialog-close>关闭</button></div>
    </div>
</div>





<script type="text/javascript" src="{{ asset('barrage/static/js/jquery-1.9.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('barrage/static/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('barrage/static/js/tinycolor-0.9.15.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('barrage/dist/js/jquery.barrager.min.js') }}"></script>

<!--颜色-->
<script type="text/javascript" src="{{ asset('barrage/static/pick-a-color/js/pick-a-color-1.2.3.min.js') }}"></script>

<!-- 弹出框 -->
<script type="text/javascript" src="{{ asset('annie/js/classie.js') }}"></script>
<script type="text/javascript" src="{{ asset('annie/js/dialogFx.js') }}"></script>

<script >
    getData();
    function getData() {
        opinion_id = 0;
        getOption();
        // getNum();
        setInterval(getOption, 2000);
        // setInterval(getNum, 50000);


    }

    // function setNum() {
    //     $.ajax({
    //         type:'GET',
    //         url:'/debate/getNum',
    //         dataType: 'json',
    //         success: function(response) {
    //             if(response.code == 0) {
    //                 var num = response.result;

    //             }
    //         }
    //     })
    // }
    function getOption() {
       
        $.ajax({
            type:'GET',
            url:'/debate/getOption',
            data:{
                opinion_id : opinion_id
            },
            dataType: 'json',
            success: function(response) {
                if(response.code == 0) {
                    response.result.forEach(function(item, index) {

                        var  val = {
                            'info':item.name + ': ' + item.content,
                            'close':false,
                            'speed':6,
                            'color': '#ffff',
                            'old_ie_color':'#000000'
                        };
                        $('body').barrager(val);

                        
                        if(index == (response.result.length -1)) {
                            opinion_id = item.id
                        }
                        val = null;
                    })
                }
            }
        })
    }

    function Tosat(title ='警告', text='暂无') {
       
        var dlgtrigger = document.querySelector( '[data-dialog]' );
        var somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) );
        
        $('#toast_warn').text(title);
        $('#toast_text').text(text);
        dlg = new DialogFx( somedialog );
        dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );
    }

    function add(stand) {
        if(stand == User.stand) {
            return;
            // Tosat('warn','已加入该阵营');
        }
        else {
            $.ajax({
            type: 'POST',
            url: '/debate/change',
            data: {
                stand: stand
            },
            dataType: 'json',
            success: function(response) {
                if(response.code == 0) {
                    if(stand == 1) {
                        $('.negative').text('加入反方阵营');
                        $('.square').text('正义即荣耀');
                    }
                    else if(stand == 2) {
                        $('.square').text('加入正方阵营');
                        $('.negative').text('黎明前的黑暗');
                    }
                    
                }
                else{
                    console.log(response.msg);
                }
            }

            });
        }
    }

    (function() {
        $('.mySend').click(function() {
            
            var msg = $('#input').val().trim();
            if(msg == '') {
                Tosat('警告','请填写内容');
                return false;
            }
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                type:'POST',
                url:'/debate/option',
                data: {
                    content: msg
                },
                dataType: 'json',
                success: function(response) {
                    if(response.code == 0) {
                        $('#input').val('');
                        Tosat('success','留言成功');
                    }
                    else {
                        Tosat('error','留言失败');
                    }
                }

            })
            
        });
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            type:'GET',
            url:'/debate/getUser',
            dataType: 'json',
            success:function(response) {
                if(response.code == 0) {
                    User = response.result;
                    if(User.stand == 1) {
                        $('.square').text('正义即荣耀');
                    }
                    else if(User.stand == 2) {
                        $('.negative').text('黎明前的黑暗');
                    } 

                }
            }
        })

        $('.square').click(function() {
            add(1);
        });
        $('.negative').click(function() {
            add(2);
        });


    })();
</script>


<script>
    var leftNum,rightNum;
    var left = 50;
    var right = 50;
    getNum();
    setInterval(getNum, 2000);
    function getNum() {
        $.ajax({
            type:'GET',
            url:'/debate/getNum',
            dataType: 'json',
            success: function(response) {
                if(response.code == 0) {
                    leftNum = response.result.square;
                    rightNum = response.result.negative;
                    updateNUmDom();
                    compute();
                }
            }
        })
    }
    function updateNUmDom() {
        $('#zhengfang').text('正方：'+ leftNum+'人');
        $('#fanfang').text('反方：'+ rightNum+'人');

    }
    function compute() {
        if(leftNum == 0 && rightNum == 0){
            left = right = 50;
            return;
        }
        left = 100*(leftNum/(leftNum+rightNum));
        right = 100*(rightNum/(leftNum+rightNum));
    }
</script>
<script type="text/javascript" src="{{ asset('rate/script.js') }}"></script>
</body>
</html>