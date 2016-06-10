<!-- chat-server.php-->





<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

// cd /Applications/MAMP/htdocs/MyRatchetFirstApp/
require dirname(__DIR__) . '/vendor/autoload.php';

$port = $_GET['port'];?>

<h1>Welcome on your server on port <?php echo $port ?></h1>

<?php
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    $port
);

$server->run();

/**
 * Run "php bin/chat-server.php", open a couple web browser windows,
 * and open a javascript console or a page with the following javascript:

 var conn = new WebSocket('wss://localhost:8080'); // MAMP is already on 8888
 conn.onopen = function(e) {
 console.log("Connection established!");
 };
 conn.onmessage = function(e) {
 console.log(e.data);
 };

 * Peut être faut il mettre cela dans un .js référencé dans un html, ou directement dans une balise script de l'html ?
 *
 * Once you see the console message "Connection established!"
 * you can start sending messages to other connected browsers:
 *
 */