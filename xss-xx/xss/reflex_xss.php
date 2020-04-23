<html>
    <head>
        <title>reflex xss</title>
    </head>
    <body>
        <div>
        <?php 
            // 一定要设置这个头来禁用浏览器检查xss
            header("X-XSS-Protection: 0");
            echo isset($_GET['payload']) ? $_GET['payload'] : 'get参数payload触发';
        ?>
        </div>
    </body>
</html>
