<?php

class Application_Form_Genero extends Zend_Form
{
    public function init()
    {
        $this->setName('genero');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setRequired(true)
                ->addValidator('NotEmpty')
                ->setLabel('Nome');
        
        $descricao = new Zend_Form_Element_Textarea('descricao');
        $descricao->setRequired(true)
                ->setLabel('Descrição');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('value', 'Enviar');
        
        $this->addElements(array($id, $nome, $descricao, $submit));
    }
}
