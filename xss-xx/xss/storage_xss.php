<html>
    <head>
        <title>storage xss</title>
    </head>
    <body>
        <div>
        <?php 
            // 模拟从持久化存储里取数据
            function get_data_from_storage() {
                return '<script> alert(1); </script>';
            }
        ?>

        <?php 
            // 一定要设置这个头来禁用浏览器检查xss
            header("X-XSS-Protection: 0");
            
            $payload = get_data_from_storage();

            echo $payload;

        ?>
        </div>
    </body>
</html>