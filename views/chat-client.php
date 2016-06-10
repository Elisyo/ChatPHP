<?php echo "<html><!-- chat-client.php -->
<head>
    <script src=\"../js/connection.js\"></script>
</head>
<body onload=\"init()\">
<h1>Chat in web browser</h1>
<p id=\"connection\"> Connection closed !</p>
<div>
    <input id=\"message\" style=\"border: 1;\">
    <button onclick=\"sendMessage()\">Send</button>
    <ul id=\"chat\">
    </ul>
</div>
<hr>
<button onclick=\"closeCon()\"><a href=\"index.html\">Back to the menu</a></button>
</body>
</html>";