<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>官方排行榜</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/rankinglist/app/views/css/index.css">

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
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="index">目录</a>
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
                <h1 class="page-header"><?php echo $datas[0]->name; ?></h1>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">简介</div>
                    <div class="panel-body">
                        <p><?php echo $datas[0]->detail; ?></p>
                    </div>

                    <!-- Table -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>名称</th>
                                <th>地点</th>
                                <th>参与人数</th>
                                <th>禁用/启用</th>
                                <th>查看</th>
                                <th>编辑</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                foreach($datas as $data) {
                            ?>
                                    <tr>
                                        <td><?php echo $data->id;?></td>
                                        <td><?php echo $data->route_title;?></td>
                                        <td><?php echo $data->route_location;?></td>
                                        <td><?php echo $data->participate_number;?></td>
                                        <td id="switch-btn">
                                        <?php
                                            require_once __DIR__."/../util/Constant.php";
                                            if($data->is_lock == Constant::$LOCK) {
                                        ?>
                                                <button type="button" class="btn btn-info unlock-btn" id="unlock-btn<?php echo $data->id;?>">启动</button>
                                        <?php
                                            } else if($data->is_lock == Constant::$UNLOCK) {
                                        ?>
                                                <button type="button" class="btn btn-danger lock-btn" id="lock-btn<?php echo $data->id;?>">禁用</button>
                                        <?php
                                            }
                                        ?>
                                        </td>
                                        <td><button type="button" class="btn btn-primary view-btn" id="view-btn<?php echo $data->id;?>">查看</button></td>
                                        <td><button type="button" class="btn btn-success edit-btn" id="edit-btn<?php echo $data->id;?>">编辑</button></td>
                                    </tr>
                            <?php
                                }

                            ?>


                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/rankinglist/app/views/js/util.js"></script>
    <script src="/rankinglist/app/views/js/interst_list.js"></script>


</body>

</html>
