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
                ->setLabel('Descrição')
                ->setAttrib('rows', 5);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
                ->setAttrib('class', 'btn btn-default btn-xs');
        
        $this->addElements(array($id, $nome, $descricao, $submit));
    }
}
