<?php

class Application_Form_Produtora extends Zend_Form
{

    public function init()
    {
        $this->setName('produtora');
        
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setRequired(true)
                ->addValidator('NotEmpty');
        
        $logo = new Zend_Form_Element_File('logo');
        $logo->setRequired(true);
        
        $descricao = new Zend_Form_Element_Textarea('descricao');
        $descricao->setRequired(true);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('value', 'Enviar');
        
        $this->addElements(array($id, $nome, $logo, $descricao, $submit));
    }


}

