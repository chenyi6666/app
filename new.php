<!DOCTYPE html>
<head>
    <style type="text/css">
        html{
            font-size:20px;
        }
        body{
            background-color:#FFFFF0;
        }
        button{
            outline:none;
        }
        .top{width:40rem;
            height: 70rem;
            margin: 0 3rem;
        }
        .top tr{
            height: 7rem;
            width: 40rem;
        }
        .top td{
            text-align: center;
        }
        .top p{
            height:4rem;
            font-size: 4rem;
            text-align: center;
        }
        .key1 button{
            border-radius:2rem;
            border:0.5rem solid #B5B5B5;
            height:6rem;
            width:14rem;
        }
        .key2,.speed{
            border-radius:2rem;
            border:0.5rem solid #B5B5B5;
            height:6rem;
            width:10rem;
        }
        .switch{
            background-color:#E3170D;
            border-radius:2rem;
            border:0.5rem solid #A52A2A;
            height:8rem;
            width:15rem;
        }
        .add{
            background-color:#808080;
        }
        .red{
            background-color:#CD2626;
        }
        .wrapper{
            width: 80%;
            margin: 0 auto;
        }
        .screen-wrapper{
            height: 150px;
            margin:0 3rem;
            display: -webkit-flex;
            display: flex;
            justify-content: center;
        }
        .screen-wrapper .text{
            width: 10%;
            text-align: center;
        }
        .screen-wrapper .text>div {
            height: 25%;
            line-height: 37.5px;
        }
        .screen-wrapper .screen{
            position: relative;
            width: 80%;
            display: -webkit-flex;
            display: flex;
        }
        .screen-wrapper .screen .screen-cover{
            position: absolute;
            top:0;
            width: 100%;
            height:100%;
            background: rgba(39,30,177,0.15);
        }
        .screen .main{
            width: 60%;
            text-align: center;
            line-height: 150px;
            font-size: 30px;
        }
        .screen .patter{
            width: 20%;
        }
        .screen .patter>div{
            height: 25%;
            padding: 0 20px;
            position: relative;
            top: 5px;
        }
        .arrow-left{
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-right: 20px solid #000;
            border-bottom: 10px solid transparent;
            display: none;
        }
        .arrow-right{
            display: none;
            float: right;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-left: 20px solid #000;
            border-bottom: 10px solid transparent;
        }
        .arrow-left.active,.arrow-right.active{
            display: block;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/asset/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="screen-wrapper">
        <div class="text">
            <div>自动</div>
            <div>制冷</div>
            <div>抽湿</div>
            <div>制热</div>
        </div>
        <div class="screen">
            <div class="patter left">
                <div><div class="arrow-left auto"></div></div>
                <div><div class="arrow-left cool"></div></div>
                <div><div class="arrow-left dry"></div></div>
                <div><div class="arrow-left heat"></div></div>
            </div>
            <div class="main">20</div>
            <div class="patter right">
                <div><div class="arrow-right"></div></div>
                <div><div class="arrow-right"></div></div>
                <div><div class="arrow-right"></div></div>
                <div><div class="arrow-right"></div></div>
            </div>
            <div class="screen-cover"></div>
        </div>
        <div class="text">
            <div>送风</div>
            <div>高风</div>
            <div></div>
            <div>低风</div>
        </div>
    </div>
    <table class="top">
        <tr class="word">
            <td>
                <p>升温</p>
            </td>
            <td></td>
            <td>
                <p>降温</p>
            </td>
        </tr>
        <tr class="key1">
            <td>
                <button  class="up" res="up"></button>
            </td>
            <td></td>
            <td>
                <button  class="down" res="down"></button>
            </td>
        </tr>
        <tr class="word">
            <td>
                <p>模式</p>
            </td>
            <td>
                <p>开/关</p>
            </td>
            <td>
                <p>风速</p>
            </td>
        </tr>
        <tr class="key">
            <td>
                <button class="key2 mode" res="moshi"></button>
            </td>
            <td>
                <button class="switch" res="off"></button>
            </td>
            <td>
                <button class="speed" res="speed"></button>
            </td>
        </tr>
        <tr class="word">
            <td>
                <p>摆风</p>
            </td>
            <td></td>
            <td>
                <p>经济</p>
            </td>
        </tr>
        <tr class="key1">
            <td>
                <button class= "baifeng" res="unmove"></button>
            </td>
            <td></td>
            <td>
                <button res="jingji"></button>
            </td>
        </tr>
        <tr class="word">
            <td>
                <p>定时开</p>
            </td>
            <td></td>
            <td>
                <p>定时关</p>
            </td>
        </tr>
        <tr class="key1">
            <td>
                <button res="open"></button>
            </td>
            <td></td>
            <td>
                <button res="close"></button>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">

    //        var _width;
    //        var _rem;
    //
    //        $(window).resize(function() {
    //            _width=$(document).width();
    //            _rem=20;
    //            _rem=_width/50;
    //
    //            $('html').css('font-size',_rem);
    //        });

    var status = 'off';
    var temperature = 20;
    var mode = 1;//模式　0=> auto,１=>cool,2=>dry,3=>heat
    var speed = 'high';
    var sendMsg = function (command) {
        if(status == 'on'){
            $.post('/index.php/?r=index/publish&type=media&command='+command,function () {

            },'json');
        }
    };
    var changeMode = function () {
        if(status != 'on') return;
        mode ++;
        mode = mode%4;
        $('.patter.left').find('.active').removeClass('active');
        $('.patter.left').children(":eq("+mode+")").children().addClass('active');
    };

    var changeSpeed = function () {
        if(status != 'on') return;
        $('.patter.right').find('.active').removeClass('active');
        if(speed == 'hign'){
            $('.patter.right').children(':eq(1)').children().addClass('active');
        }else{
            $('.patter.right').children(':eq(3)').children().addClass('active');
        }
    };

    $('.switch').on('click',function () {
        var $screen = $('.screen');
        $screen.toggleClass('on');
        status = 'on';
        var command = 'KEY_OPEN';
        if(!$screen.hasClass('on')){
            command = 'KEY_CLOSE';
            status = 'off'
        }
        temperature = 20;//初始化
        mode = 0;
        speed = 'hign';
        $screen.find('.main').text(temperature);
        changeMode();
        changeSpeed();
        sendMsg(command);
    });

    $('table .mode').on('click',function () {
        if(temperature != 20) return;
        changeMode();
        var command = 'KEY_'+mode;
        sendMsg(command);
    });

    $('table .speed').on('click',function () {
        var command = 'KEY_L';
        if(speed == 'hign'){
            speed = 'low';
        }else {
           speed = 'high';
           command = 'KEY_H';
        }
        changeSpeed();
        sendMsg(command);
    })
</script>
</body>
</html>