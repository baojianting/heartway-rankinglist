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
        textarea {
            resize: vertical;
        }
        #mapDiv {
            height: 400px;
        }
    </style>
    <script language="javascript" src="http://webapi.amap.com/maps?v=1.3&key=2240b013cff9056beaf7933f64da17af"></script>

</head>

<body>

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
                    <li class="active"><a href="new_route">新建</a>
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
                <h1 class="page-header">新建线路</h1>


                <form class="form-horizontal" role="form" action="#">
                    <div class="form-group">
                        <label for="routeTitle" class="col-sm-2 control-label">线路名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="routeTitle" placeholder="线路名称"
                                value="<?php
                                    if(isset($editArr)) {
                                        echo $editArr["route"][0]->route_title;
                                    } else {
                                        echo "";
                                    }
                                ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="routeClass" class="col-sm-2 control-label">线路分类</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="routeClass">
                                <?php
                                    if(!isset($editArr)) {
                                        foreach($dataArr as $key=>$value) {
                                ?>
                                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                <?php
                                        }
                                    } else {
                                        foreach($editArr["areas"] as $area) {
                                            if($area->id == $editArr["route"][0]->route_area_id) {
                                ?>
                                                <option selected value="<?php echo $area->id;?>"><?php echo $area->name;?></option>
                                <?php
                                            } else {


                                                ?>
                                                <option
                                                    value="<?php echo $area->id; ?>"><?php echo $area->name; ?></option>
                                            <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="routeDetail" class="col-sm-2 control-label">线路简介</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" id="routeDetail" placeholder="线路简介"><?php
                                    if(isset($editArr)) {
                                        echo $editArr["route"][0]->route_description;
                                    } else {
                                        echo "";
                                    }
                                ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="routeType" class="col-sm-2 control-label">线路类型</label>
                        <div class="col-sm-10">
                            <select id="routeType" class="form-control">
                                <?php
                                if(!isset($editArr)) {
                                    ?>
                                        <option value="0" selected>步行</option>
                                        <option value="1">骑行</option>
                                    <?php

                                } else {

                                        if($editArr["route"][0]->route_type == "0") {
                                            ?>
                                            <option value="0" selected>步行</option>
                                            <option value="1">骑行</option>
                                        <?php
                                        } else {
                                            ?>
                                            <option value="0">步行</option>
                                            <option value="1" selected>骑行</option><?php
                                        }

                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="centerLocation" placeholder="填写路线的地理位置"
                                    value="<?php
                                    if(isset($editArr)) {
                                        echo $editArr["route"][0]->route_location;
                                    } else {
                                        echo "";
                                    }

                                    ?>">
                                <span class="input-group-btn">
        <button class="btn btn-success" type="button" id="locateBtn">定位</button>
      </span>
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">

                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#routeMap" role="tab" data-toggle="tab">地图模式</a>
                                </li>
                                <li role="presentation"><a href="#routePoint" role="#routePoint" data-toggle="tab">坐标模式</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="routeMap">
                                    <div id="mapDiv"></div>
                                    <div style="padding:2px 0px 0px 5px;font-size:12px">
                                        <div id='tips'>鼠标在地图上点击绘制折线，点击右键或者双击左键结束绘制</div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="routePoint">
                                    <div>
                                        <textarea class="form-control" rows="3" placeholder="(109.728053,34.208665),(109.728053,34.208665)" id="points"><?php
                                            if(isset($editArr)) {
                                                echo $editArr["route"][0]->route_points;
                                            } else {
                                                echo "";
                                            }

                                            ?></textarea>
                                    </div>
                                    <div style="padding:2px 0px 0px 5px;font-size:12px">
                                        <div id='tips'>手动输入坐标，格式为国家规定的GCJ-02坐标。</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" id="hidden-points" value="<?php
                                    if(isset($editArr)) {
                                        echo $editArr["route"][0]->route_points;
                                    } else {
                                        echo "";
                                    }
                                ?>">
                                <input type="hidden" id="hidden-route-id" value="<?php
                                    if(isset($editArr)) {
                                        echo $editArr["route"][0]->id;
                                    } else {
                                        echo "";
                                    }
                                ?>">
                                <input type="hidden" id="hidden-route-area-id" value="<?php
                                    if(isset($editArr)) {
                                        echo $editArr["route"][0]->route_area_id;
                                    } else {
                                        echo "";
                                    }
                                ?>">

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-primary" id="submit">确定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            var mapObj, mouseTool;
            var MGeocoder;
            mapObj = new AMap.Map("mapDiv");
            var polylineOption = {
                strokeColor: "#F40343",
                strokeOpacity: 1,
                strokeWeight: 2
            };

            AMap.service(["AMap.Geocoder"], function () {
                MGeocoder = new AMap.Geocoder();
            });

            mapObj.plugin(["AMap.MouseTool"], function () {
                mouseTool = new AMap.MouseTool(mapObj);
                mouseTool.polyline(polylineOption); //使用鼠标工具绘制
                // 获取点击的坐标，将坐标写入控件
                AMap.event.addListener(mapObj, 'click', function (e) {
                    console.log(e.lnglat.getLng());
                    console.log(e.lnglat.getLat());
                    var content = $("#points").val();
                    $("#points").val(content + "(" + e.lnglat.getLng() + "," + e.lnglat.getLat() + "),");
                });

            });

            $("#locateBtn").click(function () {
                MGeocoder.getLocation($("#centerLocation").val(), function (status, result) {
                    if (status === 'complete' && result.info === 'OK') {
                        var geocode = new Array();
                        geocode = result.geocodes;

                        console.log(geocode[0].location.getLat());
                        console.log(geocode[0].location.getLng());
                        // 设置地图的中心位置
                        mapObj.setZoomAndCenter(13, new AMap.LngLat(geocode[0].location.getLng(), geocode[0].location.getLat()));
                    }
                });
            });

        });
    </script>
    <script src="../../../app/views/js/util.js"></script>
    <script src="../../../app/views/js/create_route.js"></script>
</body>

</html>
