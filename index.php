<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>swoichFood</title>

    <!-- Bootstrap -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./public/css/common.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->

    <!--[if lte IE 8]>
    <style>
        .lottery img{
            display: none;
        }
    </style>
    <![endif]-->

</head>

<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-4">
            <div class="lottery">
                <canvas id="myCanvas" width="600" height="600" style="border:1px solid #d3d3d3;">
                    当前浏览器版本过低，请使用其他浏览器尝试
                </canvas>
                <p id="message"></p>
                <img src="./public/img/start.png" id="start">
            </div>
        </div>

        <div class="col-md-6">

            <div class="panel panel-default">
                <div class="panel-body">
                    <form>`
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="exampleInputFile">File input</label>-->
<!--                            <input type="file" id="exampleInputFile">-->
<!--                            <p class="help-block">Example block-level help text here.</p>-->
<!--                        </div>-->
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Check me out
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>


        </div>
<!--        <div class="col-md-4">.col-md-4</div>-->
    </div>
</div>



<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="./public/js/jquery-3.3.1.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="./public/js/bootstrap.min.js"></script>
<script src="./public/js/common.js"></script>
<script src="./public/js/turntable.js"></script>
</body>
</html>
<script>
    var wheelSurf
    // 初始化装盘数据
    var initData = {
        "success": true,
        "list": [{
            "id": 100,
            "name": "5000元京东卡",
            "image": "./public/img/1.png",
            "rank": 1,
            "percent": 3
        },
            {
                "id": 101,
                "name": "1000元京东卡",
                "image": "./public/img/2.png",
                "rank": 2,
                "percent": 5
            },
            {
                "id": 102,
                "name": "100个比特币",
                "image": "./public/img/3.png",
                "rank": 3,
                "percent": 2
            },
            {
                "id": 103,
                "name": "50元话费",
                "image": "./public/img/4.png",
                "rank": 4,
                "percent": 49
            },
            {
                "id": 104,
                "name": "100元话费",
                "image": "./public/img/5.png",
                "rank": 5,
                "percent": 30
            },
            {
                "id": 105,
                "name": "500个比特币",
                "image": "./public/img/6.png",
                "rank": 6,
                "percent": 1
            },
            {
                "id": 106,
                "name": "500元京东卡",
                "image": "./public/img/7.png",
                "rank": 7,
                "percent": 10
            },
            // {
            //     "id": 107,
            //     "name": "500lalala",
            //     "image": "./images/7.png",
            //     "rank": 8,
            //     "percent": 100 //百分比
            // }
        ]
    }
    // 计算分配获奖概率(前提所有奖品概率相加100%)
    function getGift() {
        var percent = Math.random() * 100
        var totalPercent = 0
        for (var i = 0, l = initData.list.length; i < l; i++) {
            totalPercent += initData.list[i].percent
            if (percent <= totalPercent) {
                return initData.list[i]
            }
        }
    }


    var list = {}

    var angel = 360 / initData.list.length
    // 格式化成插件需要的奖品列表格式
    for (var i = 0, l = initData.list.length; i < l; i++) {
        list[initData.list[i].rank] = {
            id: initData.list[i].id,
            name: initData.list[i].name,
            image: initData.list[i].image
        }
    }
    // 查看奖品列表格式

    // 定义转盘奖品
    wheelSurf = $('#myCanvas').WheelSurf({
        list: list, // 奖品 列表，(必填)
        outerCircle: {
            color: '#df1e15' // 外圈颜色(可选)
        },
        innerCircle: {
            color: '#f4ad26' // 里圈颜色(可选)
        },
        dots: ['#fbf0a9', '#fbb936'], // 装饰点颜色(可选)
        disk: ['#ffb933', '#ffe8b5', '#ffb933', '#ffd57c', '#ffb933', '#ffe8b5', '#ffd57c'], //中心奖盘的颜色，默认7彩(可选)
        title: {
            color: '#5c1e08',
            font: '19px Arial'
        } // 奖品标题样式(可选)
    })

    // 初始化转盘
    wheelSurf.init()
    // 抽奖
    var throttle = true;
    $("#start").on('click', function () {

        var winData = getGift() // 正常情况下获奖信息应该由后台返回

        $("#message").html('')
        if (!throttle) {
            return false;
        }
        throttle = false;
        var count = 0
        // 计算奖品角度

        for (const key in list) {
            if (list.hasOwnProperty(key)) {
                if (winData.id == list[key].id) {
                    break;
                }
                count++
            }
        }

        // 转盘抽奖，
        wheelSurf.lottery((count * angel + angel / 2), function () {
            $("#message").html(winData.name)
            throttle = true;
        })
    })
</script>
