<?php

class Application_Model_Request
{
    private $mongo      = null;
    private $database   = 'mt4';
    private $collection = 'requests';
    
    public function __construct() {
        $this->mongo = new Mongo("mongodb://fvox:12345@localhost:27017");
    }
    
    public function __destruct() {
        $this->mongo->close();
    }

    public function addRequest($uri, $ipAddr, $protocol, $method) {
        // MongoDate() sem parâmetro gera um DateTime com NOW() por default.
        $accessDate = new MongoDate();
        
        $this->mongo->selectDB($this->database)->selectCollection($this->collection)->insert(
            array(
                'uri'        => $uri,
                'ipAddr'     => $ipAddr,
                'accessDate' => $accessDate,
                'protocol'   => $protocol,
                'method'     => $method
            )
        );
    }

    public function getRequests($orderBy, $order) {
        if (!isset($orderBy)) {
            $orderBy = '_id';
        }
        
        if (!isset($order)) {
            $order = 'DESC';
        }
        
        if ($order == 'DESC') {
            $order = -1;
        }
        elseif ($order == 'ASC') {
            $order = 1;
        }
        else {
            throw new Exception("O parâmetro '\$order' deve conter o valor 'DESC' ou 'ASC'.");
        }

        $resultSet = $this->mongo->selectDB($this->database)
                ->selectCollection($this->collection)
                ->find()
                ->sort(array($orderBy => $order));
        
        return $resultSet;
    }
}

