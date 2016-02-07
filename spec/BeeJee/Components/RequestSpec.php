<?php

namespace spec\BeeJee\Components;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BeeJee\Components\Request');
    }

    function it_return_GET()
    {
        $_GET = ['test'];
        $this->get()->shouldReturn($_GET);
    }

    function it_return_POST()
    {
        $_POST = ['test'];
        $this->post()->shouldReturn($_POST);
    }

    function it_return_default_route_as_requested_uri_if_empty_q_params_in_request()
    {
        $_GET = [];
        $this->getRequestedURI()->shouldReturn('');
    }

    function it_return_q_params_in_request_as_requested_uri()
    {
        $_GET = [
            'q' => 'controller/action'
        ];
        $this->getRequestedURI()->shouldReturn('controller/action');
    }

    function it_return_requestedURI_if_property_not_empty()
    {
        $_GET = [
            'q' => 'controller/action'
        ];
        $this->getRequestedURI()->shouldReturn('controller/action');
        $this->setRequestedURI('another_controller/action');
        $this->getRequestedURI()->shouldReturn('another_controller/action');
    }

    function it_countruct_domain_from_SERVER_array()
    {
        $_SERVER['SERVER_NAME'] = 'test.domain';
        $this->getDomain()->shouldReturn('http://test.domain/');

        $_SERVER['SERVER_NAME'] = 'test.another_domain';
        $this->getDomain()->shouldReturn('http://test.another_domain/');
    }
}
