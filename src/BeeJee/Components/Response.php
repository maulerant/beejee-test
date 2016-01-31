<?php

namespace BeeJee\Components;

class Response
{
    protected $content = '';
    protected $statusCode = 200;
    protected $version = '1.1';
    protected $statusText = 'Ok';
    
    public function __construct($statusCode = 200, $content)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
        if (isset($_SERVER['SERVER_PROTOCOL']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.0') {
            $this->version = '1.0';
        }
    }

    public function send()
    {
        $this->sendHeader();
        $this->sendContent();
    }

    public function sendHeader()
    {
        header("HTTP/{$this->version} $this->statusCode {$this->statusText}");
    }

    public function sendContent()
    {
        echo $this->content;
    }
}