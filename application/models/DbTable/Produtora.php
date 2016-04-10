<?php

class Application_Model_DbTable_Produtora extends Zend_Db_Table_Abstract
{

    protected $_name = 'produtora';

    public function addProdutora($nome, $logo, $descricao) {
        $data = array(
            'nome'      => $nome,
            'logo'      => $logo,
            'descricao' => $descricao,
        );

        return $this->insert($data);
    }
    
    public function updateProdutora ($id, $nome, $logo, $descricao) {
        $id = (int) $id;

        $data = array(
            'nome'      => $nome,
            'logo'      => $logo,
            'descricao' => $descricao,
        );
        
        return $this->update($data, array('id = ?' => $id));
    }
    
    public function deleteProdutora ($id) {
        $id = (int) $id;
        
        $this->delete(array('id = ?' => $id));
    }
}

