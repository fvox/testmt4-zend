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
            //$basename = preg_replace('', $i, $totalFiles)
            $files[$i] = $basename;
        }

        // Unificando o nome dos arquivos do array.
        $files = array_unique($files);

        $this->view->files = $files;
    }
}

