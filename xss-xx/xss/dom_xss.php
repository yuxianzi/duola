<html>
    <head>
        <title>reflex xss</title>
    </head>
    <script>
        function test() {
            var str = document.getElementById("text").value;
            document.getElementById("t").innerHTML = "<a href='" + str + "' > test link </a>";
        }
    </script>
    <body>
        <?php header("X-XSS-Protection: 0"); ?>

        <div id="t"></div>
        <pre>
        payload: ' onclick=alert(1) //
        payload: '<?php echo htmlspecialchars('><img src=# onerror=alert(1) /><') ?>' 
        </pre>
        <input type="text" id="text" value="" />
        <input type="button" id="s" value="write" onclick="test()" />
    </body>
</html>
