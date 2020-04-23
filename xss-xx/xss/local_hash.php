<html>
    <head>
        <title>reflex xss</title>
    </head>
    <body>
        <div>
        <?php 
            // 一定要设置这个头来禁用浏览器检查xss
            header("X-XSS-Protection: 0");
        ?>
        <input type="text" value="" onclick="eval(location.hash.substr(1))"/>
        </div>
    </body>
</html>
