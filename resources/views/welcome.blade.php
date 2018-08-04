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
    .clearboth{
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
        width: 100%;
        height: 37px;
        background: red;
        outline: none;
        font-size: 14px;
        color: #fff;
        font-family: "微软雅黑";
        border-radius: 0 4px 4px 0;
        border: 1px solid red;
        /* margin-top: 20px; */
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
</style>


<body>
<div style="position: relative;width: 100%;height: 100px">
    <div id="myLeft">

<<<<<<< HEAD
	<!-- <header class="codrops-header">
		<h1>对话框的效果</h1>
		<div class="button-wrap"><button data-dialog="somedialog" class="trigger">打开对话框</button></div>
	</header> -->
=======
    </div>
    <div id="myRight">

    </div>
</div>
>>>>>>> d3914f63a3a0ebe07f173bbe0828cb19ca024fd1

<div class="send">
    <div class="s_fiter">
        <div class="s_con">
<<<<<<< HEAD
            <input type="text" class="s_txt myInput" id="input">
            <span id="myInSe" style="width:30%;height:37px;float:left;margin-top:20px;">
                <button value="发布评论" class="s_sub myInput" data-dialog="somedialog">
                    <span class="mySend">发送</span>
                </button>
            </span>

=======
            <input type="text" style="margin-left: 2px" class="s_txt myInput">
            <button value="发布评论" class="s_sub myInput">
                <span class="mySend">发送</span>
            </button>
>>>>>>> d3914f63a3a0ebe07f173bbe0828cb19ca024fd1
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
        var opinion_id = 0;
        setInterval(function() {
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
        }, 50000);
    }

    function Tosat(title ='警告', text='暂无') {
       
        var dlgtrigger = document.querySelector( '[data-dialog]' );
        var somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) );
        
        $('#toast_warn').text(title);
        $('#toast_text').text(text);
        dlg = new DialogFx( somedialog );
        dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );
    }

    (function() {
        $('#myInSe').click(function() {
            console.log(';aaa');
            var msg = $('#input').val().trim();
            if(msg == '') {
                
                Tosat('警告','请填写内容');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/debate/option',
                data: {
                    content: msg
                },
                dataType: 'json',
                success: function(response) {
                    if(response.code == 0) {
                        // $('#input').val('');
                        Tosat('success','留言成功');
                    }
                    else {
                        Tosat('error','留言失败');
                    }
                }

            })
            
        })
    })();
</script>


<script>
    var leftNum = 150,rightNum = 100;
    var left = 100*(leftNum/(leftNum+rightNum));
    var right = 100*(rightNum/(leftNum+rightNum));
</script>
<script type="text/javascript" src="{{ asset('rate/script.js') }}"></script>
</body>
</html>