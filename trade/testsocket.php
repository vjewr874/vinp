<html>
<body>
ssssssssssss
    <div id="root"></div>
	<div id="data"></div>
    <script>
        var host = 'ws://127.0.0.1:12345/socket.php';
        var socket = new WebSocket(host);
        socket.onmessage = function(e) {
			var data = JSON.parse(e.data);
            document.getElementById('root').innerHTML = e.data;
			document.getElementById('data').innerHTML = data.data;
        };
    </script>
</body>
</html>