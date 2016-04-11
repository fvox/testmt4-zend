<?php

class Application_SSH {
    private $host;
    private $port;
    private $user;
    private $password;
    private $outputPath;

    public function __construct($host = null, $port = null, $user = null, $password = null, $outputPath = null) {
        $this->host       = $host;
        $this->port       = $port;
        $this->user       = $user;
        $this->password   = $password;
        $this->outputPath = $outputPath;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function setUser($user) {
        $this->user = $user;
    }
    
    public function setOutputPath($outputPath) {
        $this->outputPath = $outputPath;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function versionateFile($filepath) {
        $conn = ssh2_connect($this->host, $this->port);
        
        if (!$conn) {
            throw new Exception("Não foi possível conectar via SSH no host '$this->host:$this->port'.");
        }

        if (!ssh2_auth_password($conn, $this->user, $this->password)) {
            throw new Exception("Não foi possível autenticar no host '$this->host' com o usuário '$this->user'.");
        }

        $versionedFilePath = $this->outputPath . "/" . date('Y-m-d_H-i-s') . "_" . basename($filepath);
        if (!ssh2_scp_recv($conn, $filepath, $versionedFilePath)) {
            throw new Exception("Não foi possível buscar o arquivo '$filepath' no host '$this->host'.");
        }

        ssh2_exec($conn, "exit");

        return true;
    }
}

?>
