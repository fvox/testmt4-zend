<?php

class AcessoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $order   = $this->_request->getQuery('order');
        $orderBy = $this->_request->getQuery('orderBy');

        $request = new Application_Model_Request();
        
        $rows = $request->getRequests($orderBy, $order);
        
        $resultSet = array();
        foreach ($rows as $r) {
            $r['accessDate'] = date('Y-m-d H:i:s', $r['accessDate']->sec);

            $resultSet[] = $r;
        }
        
        $this->view->requests = $resultSet;
    }


}

