<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require '../server/Socket.php';
require "../vendors/autoload.php";




$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Socket()
        )
    ),
    8080
);

$server->run();