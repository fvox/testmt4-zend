<?php

class Application_Model_DbTable_Genero extends Zend_Db_Table_Abstract
{
    protected $_name = 'genero';

    public function addGenero($nome, $descricao) {
        $data = array(
            'nome'      => $nome,
            'descricao' => $descricao,
        );

        return $this->insert($data);
    }
    
    public function updateGenero($id, $nome, $descricao) {
        $id = (int) $id;

        $data = array(
            'nome'      => $nome,
            'descricao' => $descricao,
        );
        
        return $this->update($data, array('id = ?' => $id));
    }
    
    public function deleteGenero($id) {
        $id = (int) $id;
        
        $this->delete(array('id = ?' => $id));
    }
}

