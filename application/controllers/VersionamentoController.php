<?php

class VersionamentoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // Obtendo o path de versionamento do application.ini.
        $config         = $this->getFrontController()->getParam('bootstrap');
        $versioning     = $config->getOption('versioning');
        $versioningPath = $versioning['path'];

        $files = glob($versioningPath . "/*");

        $totalFiles = count($files);
        for ($i = 0; $i < $totalFiles; $i++) {
            $basename = basename($files[$i]);

            // Removendo a informação de hora/data do versionamento do começo do arquivo.
            $basename = preg_replace('/^\d{4}-\d{2}-\d{2}_\d{2}-\d{2}-\d{2}_/', "", $basename);
            $files[$i] = $basename;
        }

        // Unificando o nome dos arquivos do array.
        $files = array_unique($files);

        $this->view->files = $files;
    }

    public function cadastrarAction()
    {
        $form = new Application_Form_Versionamento();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                // Obtendo o path de versionamento do application.ini.
                $config     = $this->getFrontController()->getParam('bootstrap');
                $versioning = $config->getOption('versioning');
                $outputPath = $versioning['path'];
                
                $host     = $form->getValue('host');
                $port     = $form->getValue('port');
                $user     = $form->getValue('user');
                $passwd   = $form->getValue('password');
                $filepath = $form->getValue('filepath');
                
                $ssh = new Application_SSH();

                $ssh->setHost($host);
                $ssh->setPort($port);
                $ssh->setUser($user);
                $ssh->setPassword($passwd);
                $ssh->setOutputPath($outputPath);

                $ssh->versionateFile($filepath);
                
                return $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }
    }

    public function diffAction()
    {
        $filename = $this->getRequest()->getParam('file');
        
        // Obtendo o path de arquivos versionados.
        $config         = $this->getFrontController()->getParam('bootstrap');
        $versioning     = $config->getOption('versioning');
        $versioningPath = $versioning['path'];

        $files = glob($versioningPath . "/*_" . $filename);
        print_r($files);
    }


}





