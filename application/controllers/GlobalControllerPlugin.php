<?php

class GlobalControllerPlugin extends Zend_Controller_Plugin_Abstract {
    
    public function preDispatch() {
        $ipAddr   = $this->getRequest()->getServer('REMOTE_ADDR');
        $protocol = $this->getRequest()->getServer('REQUEST_SCHEME');
        $method   = $this->getRequest()->getServer('REQUEST_METHOD');
        $uri      = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();

        $request = new Application_Model_Request();
        $request->addRequest($uri, $ipAddr, $protocol, $method);
    }
}

?>