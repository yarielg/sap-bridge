<?php
namespace Inc\Util;

class Connection
{
    public $protocol;
    public $host;
    public $port;
    public $service;
    public $action;
    public $key;

    function __construct($protocol, $host , $port, $service, $action, $key)
    {
        $this->protocol = $protocol ?: 'http';
        $this->host = $host ?: '127.0.0.1';
        $this->port = $port ?: '64000';
        $this->service = $service;
        $this->action = $action;
        $this->key = $key;
    }

    

}