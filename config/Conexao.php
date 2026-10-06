<?php
namespace App\Config;

use PDO;
use PDOException;

class Conexao {
    private $host = "localhost";
    private $port = "3306";
    private $db_name = "revenda";
    private $username = "root";
    private $password = "apple";
    protected $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
        return $this->conn;
    }
}