<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Globalegrowchain\Rpc;

/**
 * Description of Application
 *
 * @author xieyihong
 */
class Application
{

    //put your code here
    protected $serviceManager;
    private $server = null;
    private $apiConfig;

    public function __construct($applicationConfig)
    {
        // Create service manager
        $serviceManagerConfig = isset($applicationConfig['service_manager']) ? $applicationConfig['service_manager'] : array();
        $this->serviceManager = new \Zend\ServiceManager\ServiceManager(new \Zend\Mvc\Service\ServiceManagerConfig($serviceManagerConfig));
        $this->serviceManager->setService('applicationConfig', $applicationConfig);
        // Load modules
        $this->loadModules();
    }

    private function loadModules()
    {
        $moduleManager = $this->serviceManager->get('ModuleManager');
        $moduleManager->loadModules();
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function getApiConfig()
    {
        return $this->apiConfig;
    }

    public function getService()
    {
        if (is_null($this->server)) {
            // Create JsonRpc server
            $this->server = new \Zend\Json\Server\Server();
        }
        return $this->server;
    }

    public function run()
    {
        // Get json server
        $this->server = $this->getService();
        // Params init
        $applicationParameter = new ApplicationParameter();
        try {
            $applicationParameter->initByRequest($this->server->getRequest(), $this->apiConfig);
        } catch (\Exception $e) {
            throw new Exception\RpcException($e->getMessage(),10001,'');
        }
    }

}
