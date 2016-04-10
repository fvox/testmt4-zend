<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initGlobalPlugin() {
        $this->bootstrap('frontController');
        
        require_once 'controllers/GlobalControllerPlugin.php'; 
        $plugin = new GlobalControllerPlugin();

        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin($plugin);
        
        return $plugin;
    }


}

