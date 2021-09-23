<?php


namespace Kliker02\VcruTask\Controllers;

use Laminas\Http\PhpEnvironment\Request;
use Laminas\Http\Response;
use Laminas\ServiceManager\ServiceManager;

/**
 * @author Alex Tokunov
 * Class AbstractController
 * @package Kliker02\VcruTask\Controllers
 */
abstract class AbstractController
{
    /**
     * @var ServiceManager
     */
    private $serviceManager = null;

    /**
     * @var Request
     */
    private $request = null;

    /**
     * @var Response
     */
    private $response = null;

    public function __construct(ServiceManager $sm, Request $request, Response $response)
    {
        $this->serviceManager = $sm;
        $this->request = $request;
        $this->response = $response;
    }

    protected function getServiceManager() {
        return $this->serviceManager;
    }

    protected function getRequest() {
        return $this->request;
    }

    protected function getResponse() {
        return $this->response;
    }

}