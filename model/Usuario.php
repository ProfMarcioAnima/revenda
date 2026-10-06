<?php
namespace App\Model;

use PDO;

class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function logar($login, $senha) {
        $sql = "SELECT login, senha FROM {$this->table} WHERE login = :login AND senha = :senha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}