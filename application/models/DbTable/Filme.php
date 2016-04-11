<?php

class Application_Model_DbTable_Filme extends Zend_Db_Table_Abstract
{

    protected $_name = 'filme';

    public function addFilme($nome, $produtora_id, $genero_id, $ano, $sinopse, $poster) {
        $data = array(
            'nome'         => $nome,
            'produtora_id' => $produtora_id,
            'genero_id'    => $genero_id,
            'ano'          => $ano,
            'sinopse'      => $sinopse,
            'poster'       => $poster,
        );

        return $this->insert($data);
    }
    
    public function updateFilme($id, $nome, $produtora_id, $genero_id, $ano, $sinopse, $poster) {
        $data = array(
            'nome'         => $nome,
            'produtora_id' => $produtora_id,
            'genero_id'    => $genero_id,
            'ano'          => $ano,
            'sinopse'      => $sinopse,
            'poster'       => $poster,
        );
        
        return $this->update($data, array('id = ?' => (int) $id));
    }
    
    public function deleteFilme($id) {        
        $this->delete(array('id = ?' => (int) $id));
    }
    
    public function getAll() {
        $select = $this->select();
        
        $select->setIntegrityCheck(false);
        $select->from($this->_name);
        
        $select->joinLeft('produtora', 'filme.produtora_id = produtora.id', array('produtora_nome' => 'nome'));
        $select->joinLeft('genero', 'filme.genero_id = genero.id', array('genero_nome' => 'nome'));
        
        $rows = $this->fetchAll($select);
        
        return $rows;
    }
        
        
    

}

