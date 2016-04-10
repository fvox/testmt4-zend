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

}
