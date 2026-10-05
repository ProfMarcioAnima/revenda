<?php
namespace App\Model;

use PDO;

class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    // Método de login
    public function logar($usuario, $senha) {
        $sql = "SELECT usuario, senha FROM $this->tabela WHERE usuario = :usuario AND senha = :senha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            session_start();
            $_SESSION['logado'] = true;
            header('Location: ../view/agenda.php?logado=true');
        } else {
            header('Location: ../view/index.php?erro=login');
        }
    }
}