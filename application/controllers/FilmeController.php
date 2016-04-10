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
        
        $this->view->filmes = $filmes->fetchAll();
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
              
                $poster = file_get_contents($files['logo']['tmp_name']);

                $filme = new Application_Model_DbTable_Filme();
                $filme->addFilme($nome, $produtora_id, $genero_id, $ano, $sinopse, $poster);
                
                return $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }
    }


}



