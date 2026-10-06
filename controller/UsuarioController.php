<?php
namespace App\Controller;

use App\Config\Conexao;
use App\Model\Usuario;
use PDO;

class UsuarioController {
    private $Usuario;
    private $db;

    public function __construct(?Usuario $usuario = null, ?PDO $db = null) {
        if ($db !== null) {
            $this->db = $db;
        } else {
            $this->db = (new Conexao())->getConnection();
        }

        if ($usuario !== null) {
            $this->Usuario = $usuario;
        } else {
            $this->Usuario = new Usuario($this->db);
        }
    }

    public function logar() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }

        $user = $_POST['usuario'] ?? $_POST['login'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $senhaHash = hash('sha256', $senha);

        $resultado = $this->Usuario->logar($user, $senhaHash);

        if ($resultado) {
            $_SESSION['admin_logged'] = true;
            $_SESSION['usuario'] = $resultado['login'];
            $_SESSION['sucesso'] = 'Login realizado com sucesso!';
            $this->redirecionar("index.php?action=admin_dashboard");
        } else {
            $this->redirecionar("index.php?action=login&erro=1");
        }
    }

    public function sair() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        $_SESSION = [];
        @session_destroy();
        $this->redirecionar("index.php?action=login&deslogado=1");
    }

    protected function redirecionar($url) {
        if (!headers_sent()) {
            @header("Location: " . $url);
        }
        if (php_sapi_name() !== 'cli') {
            exit;
        }
    }
}