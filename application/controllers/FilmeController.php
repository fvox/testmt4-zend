<?php

class FilmeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $filmes = new Application_Model_DbTable_Filme();
        
        //$this->view->filmes = $filmes->fetchAll();
        //print_r($filmes->getAll());
        $this->view->filmes = $filmes->getAll();
    }

    public function cadastrarAction()
    {
        $form = new Application_Form_Filme();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                $nome = $form->getValue('nome');
                $produtora_id = $form->getValue('produtora_id');
                $genero_id = $form->getValue('genero_id');
                $ano = $form->getValue('ano');
                $sinopse = $form->getValue('sinopse');
                
                $upload = new Zend_File_Transfer();
                $files = $upload->getFileInfo();
              
                $poster = file_get_contents($files['poster']['tmp_name']);

                $filme = new Application_Model_DbTable_Filme();
                $filme->addFilme($nome, $produtora_id, $genero_id, $ano, $sinopse, $poster);
                
                return $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }
    }

    public function posterAction()
    {
        $filme = new Application_Model_DbTable_Filme();
        
        $id = (int) $this->getRequest()->getParam('id');
        
        $row = $filme->fetchRow(array('id = ?' => $id))->toArray();

        if (!$row) {
            exit();
        }
        
        $poster = $row['poster'];
        
        header("Content-type: image");
        echo $poster;
        
        exit();

    }

    public function editAction()
    {
        $form = new Application_Form_Filme();
        $form->submit->setLabel('Salvar');
        
        $this->view->form = $form;
        
        $filme = new Application_Model_DbTable_Filme();
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                $id = (int) $form->getValue('id');
                
                $nome = $form->getValue('nome');
                $produtora_id = $form->getValue('produtora_id');
                $genero_id = $form->getValue('genero_id');
                $ano = $form->getValue('ano');
                $sinopse = $form->getValue('sinopse');
                
                $upload = new Zend_File_Transfer();
                $files = $upload->getFileInfo();
              
                $poster = file_get_contents($files['poster']['tmp_name']);
             
                $filme->updateFilme($id, $nome, $produtora_id, $genero_id, $ano, $sinopse, $poster);
                
                $this->_helper->redirector('index');
            }
        }
        else {
            $id = $this->_getParam('id', 0);
            
            if ($id > 0) {
                $data = $filme->fetchRow(array('id = ?' => $id))->toArray();
                $form->populate($data);
            }
        }
    }

    public function deleteAction()
    {
        $filme = new Application_Model_DbTable_Filme();
        
        if ($this->getRequest()->isPost()) {
            $id = $this->getRequest()->getPost('id');
    
            $filme->deleteFilme($id);
        }

        $this->_helper->redirector('index');
        
        return ;
    }


}









