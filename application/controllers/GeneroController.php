<?php

class GeneroController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $genero = new Application_Model_DbTable_Genero();

        $this->view->generos = $genero->fetchAll();
    }

    public function cadastrarAction()
    {
        $form = new Application_Form_Genero();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                $nome = $form->getValue('nome');
                $descricao = $form->getValue('descricao');
                
                $genero = new Application_Model_DbTable_Genero();
                $genero->addGenero($nome, $descricao);
                
                $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }
    }

    public function deleteAction()
    {
        $genero = new Application_Model_DbTable_Genero();
        
        if ($this->getRequest()->isPost()) {
            $id = $this->getRequest()->getPost('id');

            $genero->deleteGenero($id);
        }
        $this->_helper->redirector('index');
        
        return ;
    }

    public function editAction()
    {
        $form = new Application_Form_Genero();
        $form->submit->setLabel('Salvar');
        
        $this->view->form = $form;
        
        $genero = new Application_Model_DbTable_Genero();
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                $id = (int) $form->getValue('id');
                
                $nome = $form->getValue('nome');
                
                $descricao = $form->getValue('descricao');
                
                $genero->updateGenero($id, $nome, $descricao);
                
                $this->_helper->redirector('index');
            }
        }
        else {
            $id = $this->_getParam('id', 0);
            
            if ($id > 0) {
                $data = $genero->fetchRow(array('id = ?' => $id))->toArray();
                $form->populate($data);
            }
        }
    }


}







