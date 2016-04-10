<?php

class Application_Form_Filme extends Zend_Form
{
    public function init()
    {
        $this->setName('filme');
        
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setRequired(true)
                ->addValidator('NotEmpty')
                ->setLabel('Nome');
        
        $produtora_id = new Zend_Form_Element_Select('produtora_id');
        $produtora_id->setLabel('Produtora');
        $produtora = new Application_Model_DbTable_Produtora();
        $produtoras = $produtora->fetchAll()->toArray();
        
        foreach ($produtoras as $p) {
            $produtora_id->addMultiOption($p['id'], $p['nome']);
        }
        
        $genero_id = new Zend_Form_Element_Select('genero_id');
        $genero_id->setLabel('Gênero')
                ->setRequired(true);
        $genero = new Application_Model_DbTable_Genero();
        $generos = $genero->fetchAll()->toArray();
        
        foreach ($generos as $g) {
            $genero_id->addMultiOption($g['id'], $g['nome']);
        }
        
        $ano = new Zend_Form_Element_Text('ano');
        $ano->addFilter('Int')
                ->addValidator('NotEmpty')
                ->setLabel('Ano');
        
        $sinopse = new Zend_Form_Element_Textarea('sinopse');
        $sinopse->addValidator('NotEmpty')
                ->setLabel('Sinopse')
                ->setAttrib('rows', 5);
        
        $poster = new Zend_Form_Element_File('poster');
        $poster->setLabel('Poster');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('value', 'Enviar');
        
        $this->addElements(array($id, $nome, $produtora_id, $genero_id, $ano, $sinopse, $poster, $submit));
        //$produtora_id->addMultiOption($produtoras);
        /* Form Elements & Other Definitions Here ... */
    }


}

