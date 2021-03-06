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
                    <li class="active"><a href="index">目录</a>
                    </li>
                    <li><a href="new_route">新建</a>
                    </li>
                </ul>
         
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">全国地区</h1>

                <div class="row placeholders">

                    <?php
                    foreach($dataArr as $key=>$value) {
                    ?>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <img src="../../../app/views/asset/beijing.png" class="img-responsive" alt="Generic placeholder thumbnail">
                            <h4><?php echo $key;?></h4>
                            <?php
                                if($value == 0) {
                            ?>
                                    共<?php echo $value;?>条线路
                            <?php
                                } else {
                            ?>
                                    <a href="interst_list?areaId=<?php echo $key?>">共<?php echo $value;?>条线路</a>
                            <?php
                                }

                            ?>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>


</body>

</html>
