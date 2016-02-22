<?php
namespace BeeJee\Components;

class Request
{
    protected $requestedURI = '';

    public function __construct()
    {
        $this->setRequestedURI($this->getRequestedURI());
    }


    /**
     * @return string
     */
    public function getDomain()
    {
        $domain = empty($_SERVER['SERVER_NAME'])? $_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
        return 'http://' . $domain . '/';
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $_GET;
    }

    /**
     * @return mixed
     */
    public function post()
    {
        return $_POST;
    }

    /**
     * @param $uri
     */
    public function setRequestedURI($uri)
    {
        $this->requestedURI = $uri;
    }

    /**
     * @return string
     */
    public function getRequestedURI()
    {
        if(!empty($this->requestedURI)) {
            return $this->requestedURI;
        }
        return empty($_GET['q']) ? '' : $_GET['q'];
    }
}