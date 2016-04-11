<?php

class Application_Form_Versionamento extends Zend_Form
{

    public function init()
    {
        $this->setName('versionamento');
        
        $host = new Zend_Form_Element_Text('host');
        $host->setLabel('Host')
                ->addValidator('NotEmpty');
        
        $port = new Zend_Form_Element_Text('port');
        $port->setLabel('port')
                ->addValidator('NotEmpty')
                ->addFilter('Int')
                ->setValue(22);
        
        $user = new Zend_Form_Element_Text('user');
        $user->setLabel('Username')
                ->addValidator('NotEmpty');
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                ->addValidator('NotEmpty');
   
        $filepath = new Zend_Form_Element_Text('filepath');
        $filepath->setLabel('File path')
                ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
                ->setAttrib('class', 'btn btn-default btn-xs');
        
        $this->addElements(array($host, $port, $user, $password, $filepath, $submit));
    }
}

