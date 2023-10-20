<html>
<body>
    <div id="root"></div>
    <script>
        var host = 'wss://price.investpro.asia:8868/web';
        var socket = new WebSocket(host);
        socket.onmessage = function(e) {
			console.log(e);
            document.getElementById('root').innerHTML = e.data;
        };
    </script>
</body>
</html>