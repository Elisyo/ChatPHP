<?php //Chat.php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})<br/>";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        foreach ($this->clients as $client) {
            //if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            //}
        }
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "<br/>"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected<br/>";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}<br/>";
        $conn->close();
    }
}

