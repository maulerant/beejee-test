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
        return 'http://' . $_SERVER['SERVER_NAME'] . '/';
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