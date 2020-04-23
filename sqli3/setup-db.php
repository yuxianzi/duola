<?php
include_once 'db.inc.php';
$dbhost=DBHOST;
$dbuser=DBUSER;
$dbpw=DBPW;
$dbname=DBNAME;
$mes_connect='';
$mes_create='';
$mes_data='';
$mes_ok='';

if(isset($_POST['submit'])){
    //判断数据库连接
    if(!@mysqli_connect($dbhost, $dbuser, $dbpw)){
        exit('数据连接失败，请仔细检查inc/config.inc.php的配置');
    }
    $link=mysqli_connect(DBHOST, DBUSER, DBPW);
    $mes_connect.="<p class='notice'>数据库连接成功!</p>";
    //如果存在,则直接干掉
    $drop_db="drop database if exists $dbname";
    if(!@mysqli_query($link, $drop_db)){
        exit('初始化数据库失败，请仔细检查当前用户是否有操作权限');
    }
    //创建数据库
    $create_db="CREATE DATABASE $dbname";
    if(!@mysqli_query($link,$create_db)){
        exit('数据库创建失败，请仔细检查当前用户是否有操作权限');
    }
    $mes_create="<p class='notice'>新建数据库:".$dbname."成功!</p>";
    //创建数据.选择数据库
    if(!@mysqli_select_db($link, $dbname)){
        exit('数据库选择失败，请仔细检查当前用户是否有操作权限');
    }

    //创建challenge_clue表
    $creat_challenge_clue=
        "CREATE TABLE IF NOT EXISTS `challenge_clue` (
    `id` int(11)  NOT NULL AUTO_INCREMENT,
    `info` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3";
    if(!@mysqli_query($link,$creat_challenge_clue)){
        exit('创建challenge_clue表失败，请仔细检查当前用户是否有操作权限');
    }

    //往challenge_clue表里面插入默认的数据
    $insert_users = "INSERT INTO `challenge_clue` (`id`, `info`) VALUES
(1, 'Is this the real life?'),
(2, 'Is this just fantasy?');";

    if(!@mysqli_query($link,$insert_users)){
        echo $link->error;
        exit('创建users表数据失败，请仔细检查当前用户是否有操作权限');
    }

    //创建表offices
    $create_offices=
        "CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;";
    if(!@mysqli_query($link,$create_offices)){
    	 echo $link->error;
        exit('创建offices表失败，请仔细检查当前用户是否有操作权限');
    }

    $insert_products="INSERT INTO `offices` (`id`, `city`, `address`, `phone`) VALUES
(1, 'Stockholm', 'Birger Jarlsgatan 7, 4 tr', '+46 8-616 99 40'),
(2, 'Berlin', 'Friedrichstraße 68', '+49 173 329 6295'),
(3, 'Hamburg', 'Ferdinandstraße 35', '+49 403 07 39 810'),
(4, 'Helsinki', 'Arkadiankatu 23 C', '+358 (0)20 7705600'),
(5, 'London', '8 Ganton Street', '+44 7469 214 950'),
(6, 'München', 'Sternstraße 5', '+49 89 885 627 88'),
(7, 'Oslo', 'Karl Johans gate 23B, 4. etasje', '+47 224 25 150'),
(8, 'Paris', '149 Rue Saint-Honoré', '+33 635 46 15 03');";

    if(!@mysqli_query($link,$insert_products)){
        exit('创建products数据失败，请仔细检查当前用户是否有操作权限');
    }
   
  //创建表users
    $create_users=
        "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;";
    if(!@mysqli_query($link,$create_users)){
    	 echo $link->error;
        exit('创建users表失败，请仔细检查当前用户是否有操作权限');
    }

    $insert_products="INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'Welc0meT0NetlightEdgeC0nferenceInSt0ckh0lm!');";

    if(!@mysqli_query($link,$insert_products)){
        exit('创建products数据失败，请仔细检查当前用户是否有操作权限');
    }


    $mes_data="<p class='notice'>创建数据库数据成功!</p>";
    $mes_ok="<p class='notice'>好了!ok!～<a href='index.php'>点击这里</a>进入首页</p>";


}
?>


<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
<!--                <li>-->
<!--                    <i class="ace-icon fa fa-home home-icon"></i>-->
<!--                    <a href="#">Home</a>-->
<!--                </li>-->
                <li class="active">系统初始化安装</li>
            </ul><!-- /.breadcrumb -->

        </div>
<div class="page-content">

    <div id=install_main>
        <p class="main_title">点击“安装/初始化”按钮;</p>
        <form method="post">
            <input type="submit" name="submit" value="安装/初始化"/>
        </form>

    </div>
    <div class="info" style="color: #D6487E;padding-top: 40px;">
        <?php
        echo $mes_connect;
        echo $mes_create;
        echo $mes_data;
        echo $mes_ok;
        ?>

    </div>

</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->