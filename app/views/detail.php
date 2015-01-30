<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>官方排行榜</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../app/views/css/index.css">
    <style>
    #iCenter{
        
        height: 800px;
    }
    </style>
    <script language="javascript" src="http://webapi.amap.com/maps?v=1.3&key=2240b013cff9056beaf7933f64da17af"></script>
    <script>
     var mapObj;
     function mapInit() {
        var pointsStr = $("#hidden-points").val();
        // console.log(pointsStr);
        var pointsArr = pointsStr.split(",");

	    mapObj = new AMap.Map("iCenter",{
		rotateEnable:true,
		dragEnable:true,
		zoomEnable:true,
		zooms:[3,18],
		//二维地图显示视口
		view: new AMap.View2D({
			center:new AMap.LngLat(pointsArr[0],pointsArr[1]),//地图中心点
			zoom:13 //地图显示的缩放级别
		})
	});	

         drawLine(pointsArr);
}
        
    function drawLine(pointsArr){
        var lineArr = new Array();//创建线覆盖物节点坐标数组
        for(var i = 0; i < pointsArr.length - 1; ) {
            lineArr.push(new AMap.LngLat(pointsArr[i++],pointsArr[i++]));
        }
   polyline = new AMap.Polyline({ 
   path:lineArr, //设置线覆盖物路径
   strokeColor:"#F40343", //线颜色
   strokeOpacity:1, //线透明度 
   strokeWeight:4, //线宽
   strokeStyle:"solid", //线样式
   strokeDasharray:[10,5] //补充线样式 
   }); 
   polyline.setMap(mapObj);
	mapObj.setFitView(); 
    }
    </script>
</head>

<body onLoad="mapInit()">

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">官方线路</a>
                <form action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/forum/public/index.php/login'?>" method="post" class="navbar-form navbar-right">
                    <input type="hidden" name="username" value="<?php echo $username?>">
                    <input type="hidden" name="password" value="<?php echo $password?>">
                    <input type="submit" value="首页" class="btn btn-primary">
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li><a href="index">目录</a>
                    </li>
                    <li><a href="new_route">新建</a>
                    </li>
                </ul>
                <!--
                <ul class="nav nav-sidebar">
                    <li><a href="#">other</a>
                    </li>
                    <li><a href="#">other</a>
                    </li>
                </ul>
                -->
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header"><?php echo $route->route_title;?></h1>
                
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#iCenter" role="tab" data-toggle="tab">线路</a></li>
                    <li role="presentation"><a href="#description" role="tab" data-toggle="tab">简介</a></li>
                </ul>
           
                <div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="iCenter"></div>
  <div role="tabpanel" class="tab-pane" id="description">
   <p style="text-indent:2em">
    <?php echo $route->route_description; ?></p>
    <div class="panel panel-success">
        <div class="panel-heading">坐标信息</div>
       <div class="panel-body">
          <ul class="list-group">
              <?php
                $points = $route->route_points;
                require_once __DIR__."/../util/Util.php";
                $points = Util::formatPoints($points);
                // echo $points;
                $pointsArr = explode(",", $points);
                // print_r($pointsArr);
                // $position = 0;
                for($i = 0; $i < count($pointsArr) - 1;) {
              ?>
                    <li class="list-group-item"><?php echo trim($pointsArr[$i++]); ?>, <?php echo trim($pointsArr[$i++]); ?></li>
              <?php
                }
              ?>
<!--
  <li class="list-group-item">"116.368904","39.913423"</li>
  <li class="list-group-item">"116.368904","39.913423"</li>
  <li class="list-group-item">"116.368904","39.913423"</li>
  <li class="list-group-item">"116.368904","39.913423"</li>-->
          </ul>
       </div>
        
    </div>
 </div>
</div>
            </div>
        </div>
    </div>
    <div>
        <input type="hidden" id="hidden-points" value="<?php echo $points;?>">
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>


</body>

</html>
