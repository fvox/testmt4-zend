<?php

class ProdutoraController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $produtoras = new Application_Model_DbTable_Produtora();

        $this->view->produtoras = $produtoras->fetchAll();
    }

    public function cadastrarAction()
    {
        $form = new Application_Form_Produtora();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                $nome = $form->getValue('nome');
                
                $upload = new Zend_File_Transfer();
                $files = $upload->getFileInfo();
              
                $logo = file_get_contents($files['logo']['tmp_name']);
             
                $descricao = $form->getValue('descricao');
                
                $produtora = new Application_Model_DbTable_Produtora();
                $produtora->addProdutora($nome, $logo, $descricao);
 
                return $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }
    }

    public function logoAction()
    {
        $produtora = new Application_Model_DbTable_Produtora();
        
        $id = (int) $this->getRequest()->getParam('id');
        
        $row = $produtora->fetchRow(array('id = ?' => $id))->toArray();
        
        if (!$row) {
            throw new Exception("Produtora não encontrada.");
        }
        
        $logo = $row['logo'];
        
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        header("Content-type: image");
        echo $logo;
        
        return ;
    }

    public function deleteAction()
    {
        $produtora = new Application_Model_DbTable_Produtora();
        
        if ($this->getRequest()->isPost()) {
            $id = $this->getRequest()->getPost('id');
    
            $produtora->deleteProdutora($id);
        }
        $this->_helper->redirector('index');
        
        return ;
    }

    public function editAction()
    {
        $form = new Application_Form_Produtora();
        $form->submit->setLabel('Salvar');
        
        $this->view->form = $form;
        
        $produtora = new Application_Model_DbTable_Produtora();
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                $id = (int) $form->getValue('id');
                
                $nome = $form->getValue('nome');
                
                $upload = new Zend_File_Transfer();
                $files = $upload->getFileInfo();
              
                $logo = file_get_contents($files['logo']['tmp_name']);
             
                $descricao = $form->getValue('descricao');
                
                $produtora->updateProdutora($id, $nome, $logo, $descricao);
                
                $this->_helper->redirector('index');
            }
        }
        else {
            $id = $this->_getParam('id', 0);
            
            if ($id > 0) {
                $data = $produtora->fetchRow(array('id = ?' => $id))->toArray();
                $form->populate($data);
            }
        }
    }
}









