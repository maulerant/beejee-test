<?php

namespace spec\BeeJee\Components;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RouteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BeeJee\Components\Route');
    }

    function it_have_routes_as_empty_array_if_initialize_by_default()
    {
        $this->getRoutes()->shouldReturn([]);
    }

    function it_have_routes_array_if_initialized_array()
    {
        $routes = [
            'index/index' => [
                'controller' => 'IndexController',
                'action' => 'actionIndex'
            ]
        ];
        $this->beConstructedWith($routes);
        $this->getRoutes()->shouldReturn($routes);
    }

    function it_return_index_index_as_default_route_if_initialize_with_empty_default_routes()
    {
        $this->getDefaultRoute()->shouldReturn('index/index');
    }

    function it_return_index_index_as_default_route_if_initialize_without_default_routes()
    {
        $routes = [
            'index/index' => [
                'controller' => 'IndexController',
                'action' => 'actionIndex'
            ]
        ];
        $this->beConstructedWith($routes);
        $this->getDefaultRoute()->shouldReturn('index/index');
    }

    function it_return_default_route_if_initialize_with_default_routes()
    {
        $routes = [
            'default' => 'controller/action',
            'index/index' => [
                'controller' => 'IndexController',
                'action' => 'actionIndex'
            ]
        ];
        $this->beConstructedWith($routes);
        $this->getDefaultRoute()->shouldReturn('controller/action');
    }

    function it_create_classname_of_controller_from_uri()
    {
        $this->getControllerClass('index')->shouldReturn("BeeJee\\Controllers\\IndexController");
        $this->getControllerClass('controller/action')->shouldReturn("BeeJee\\Controllers\\ControllerController");
        $this->shouldThrow('\Exception')->during('getControllerClass', ['']);
    }

    function it_create_action_method_from_uri()
    {
        $this->getAction('controller')->shouldReturn("actionIndex");
        $this->getAction('controller/action')->shouldReturn("actionAction");
        $this->shouldThrow('\Exception')->during('getAction', ['']);
    }
}
