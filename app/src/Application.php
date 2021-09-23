<?php

namespace Kliker02\VcruTask;

use Kliker02\VcruTask\Config\ConfigInterface;
use Kliker02\VcruTask\Database\ConnectionFactory;
use Laminas\Http\Headers;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\Http\Response;
use Laminas\Router\Http\RouteMatch;
use Laminas\Router\RouteStackInterface;
use Laminas\ServiceManager\ServiceManager;


/**
 * @author Alex Tokunov
 * Class Application
 * @package Kliker02\VcruTask
 */
class Application
{
    /**
     * @var Request
     */
    private $request = null;

    /**
     * @var Response
     */
    private $response = null;

    /**
     * @var ServiceManager
     */
    private $serviceManager = null;

    /**
     * @var RouteMatch
     */
    private $routeMatch = null;

    /**
     * @var RouteStackInterface
     */
    private $router = null;

    /**
     * @author Alex Tokunov
     * Configure application
     * @param ConfigInterface $Config
     * @return $this
     * @throws \Exception
     */
    public function init(ConfigInterface $Config)
    {
        $smConfig = new \Laminas\ServiceManager\Config();
        $this->serviceManager = (new \Laminas\ServiceManager\ServiceManager($Config->getConfig()));
        $smConfig->configureServiceManager($this->serviceManager);
        $this->serviceManager->setService('ApplicationConfig', $Config->getConfig());

        $this->router = (new RouterFactory)($this->serviceManager, $Config);

        $this->request = $this->request ?: new \Laminas\Http\PhpEnvironment\Request();

        $headers = new Headers();
        $headers->addHeaderLine('Content-type', 'application/json');
        $this->response = new Response();
        $this->response->setHeaders($headers);
        $this->response->setStatusCode(Response::STATUS_CODE_200);

        $DbConnection = (new ConnectionFactory)($this->serviceManager);
        $this->serviceManager->setService('DbConnection', $DbConnection);


        return $this;
    }

    /**
     * @author Alex Tokunov
     * Runs matching route and dispatch controller
     */
    public function run()
    {
        try {
            if (!$this->routeMatch = $this->router->match($this->request)) {
                throw new \Exception('Route not found');
            }

            $Controller = $this->routeMatch->getParam('controller');
            $Response = (new $Controller($this->serviceManager, $this->request, $this->response))
                ->{$this->routeMatch->getParam('action')}(new RouteParams($this->routeMatch->getParams()));

            $this->response->setContent($Response->render());

        } catch (\Exception $e) {
            if ($this->response->isOk()) {
                $this->response->setStatusCode(Response::STATUS_CODE_500);
            }

            if (!strlen($this->response->getContent())) {
                $this->response->setContent(json_encode(
                    ['message' => $e->getMessage(), 'code' => $this->response->getStatusCode(), 'data' => null]
                ));
            }
        }

        ResponseSender::send($this->response);
    }
}