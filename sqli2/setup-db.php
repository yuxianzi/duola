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

    //创建users表
    $creat_users=
        "CREATE TABLE IF NOT EXISTS `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(30) NOT NULL,
    `password` varchar(66) NOT NULL,
    `fname` varchar(30) NOT NULL,
    `description` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4";
    if(!@mysqli_query($link,$creat_users)){
        exit('创建users表失败，请仔细检查当前用户是否有操作权限');
    }

    //往users表里面插入默认的数据
    $insert_users = "INSERT INTO `users` (`id`, `username`, `password`, `fname`, `description`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'All hail the admin!!'),
(2, 'bob', '5f4dcc3b5aa765d61d8327deb882cf99', 'bobby', 'Sup! I love swimming!'),
(3, 'ramesh', '9aeaed51f2b0f6680c4ed4b07fb1a83c', 'ramesh', 'I love 5 star!'),
(4, 'suresh', '9aeaed51f2b0f6680c4ed4b07fb1a83c', 'suresh', 'I love 5 star toooo!'),
(5, 'alice', 'c93239cae450631e9f55d71aed99e918', 'alice', 'In wonderland right now :O'),
(6, 'voldemort', '856936b417f82c06139c74fa73b1abbe', 'voldemort', 'How dare you! Avada kedavra!'),
(7, 'frodo', 'f0f8820ee817181d9c6852a097d70d8d', 'frodo', 'Need to go to Mordor. Like right now!'),
(8, 'hodor', 'a55287e9d0b40429e5a944d10132c93e', 'hodor', 'Hodor'),
(65, 'rhombus', 'e52848c0eb863d96bc124737116f23a4', 'rambo', 'Im the rambo!! Bwahahaha!');";

    if(!@mysqli_query($link,$insert_users)){
        echo $link->error;
        exit('创建users表数据失败，请仔细检查当前用户是否有操作权限');
    }

    //创建表products
    $create_products=
        "CREATE TABLE IF NOT EXISTS `products` (
    `id` int(11)  NOT NULL AUTO_INCREMENT,
    `product_name` varchar(30) NOT NULL,
    `product_type` varchar(30) NOT NULL,
    `description` varchar(200) NOT NULL,
    `price` int(5) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13";
    if(!@mysqli_query($link,$create_products)){
    	 echo $link->error;
        exit('创建products表失败，请仔细检查当前用户是否有操作权限');
    }

    $insert_products="INSERT INTO `products` (`id`, `product_name`, `product_type`, `description`, `price`) VALUES
(1, 'pillows', 'bedroom linen', 'soft fluffy pillows', 4000),
(5, 'book shelf', 'furniture', 'hard balsa wood furniture', 3200),
(6, 'pressure cooker', 'kitchen', '5 ltr. pressure cooker for the entire family', 12000),
(7, 'shampoo', 'healthcare', 'anti dandruff shampoo for oily hair', 2300),
(8, 'tubelight', 'lighting', 'bright light for the entire house', 1200),
(9, 'headphones', 'computers', 'high quality Bose standard china made headphones', 200),
(10, 'ADSL2 router', 'wireless devices', 'long range wireless router for the entire locality', 9090),
(11, 'buffalo', 'animal', 'endless supply of authentic milk', 23000),
(12, 'bicycle', 'vehicles', 'the best in the market, now ride to office!', 10000);";

    if(!@mysqli_query($link,$insert_products)){
        exit('创建products数据失败，请仔细检查当前用户是否有操作权限');
    }

    $mes_data="<p class='notice'>创建数据库数据成功!</p>";
    $mes_ok="<p class='notice'>好了，可以开搞了～<a href='index.php'>点击这里</a>进入首页</p>";


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