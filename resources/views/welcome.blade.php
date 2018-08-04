<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('TITLE') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/static/css/bootstrap.min.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/css/demo.css') }}">

    <!--弹幕-->
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/static/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/dist/css/barrager.css') }}">

    <!--颜色-->
    <link rel="stylesheet" type="text/css" href="{{ asset('barrage/static/pick-a-color/css/pick-a-color-1.2.3.min.css') }}">

</head>
<style>
    *{
        margin: 0;
        padding: 0;
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
        float: left;
    }
</style>
<body>


<div class="send">
    <div class="s_fiter">
        <div class="s_con">
            <input type="text" class="s_txt myInput">
            <input type="button" value="发布评论" class="s_sub myInput">
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('barrage/static/js/jquery-1.9.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('barrage/static/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('barrage/static/js/tinycolor-0.9.15.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('barrage/dist/js/jquery.barrager.min.js') }}"></script>

<!--颜色-->
<script type="text/javascript" src="{{ asset('barrage/static/pick-a-color/js/pick-a-color-1.2.3.min.js') }}"></script>
<script>
    var  item={
        'info':'我是魏亚林',
        'close':false,
        'speed':6,
        'color': 'red',
        'old_ie_color':'#000000'
    };
    $('body').barrager(item);
    $('body').barrager(item);
    $('body').barrager(item);
    $('body').barrager(item);
    $('body').barrager(item);
    $('body').barrager(item);
    $('body').barrager(item);
</script>
</body>
</html>