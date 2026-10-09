<?php
namespace App\Controller;

use App\Config\Conexao;
use App\Model\Veiculo;
use PDO;

class VeiculoController {
    private $Veiculo;
    private $db;

    public function __construct(?Veiculo $veiculo = null, ?PDO $db = null) {
        if ($db !== null) {
            $this->db = $db;
        } else {
            $this->db = (new Conexao())->getConnection();
        }

        if ($veiculo !== null) {
            $this->Veiculo = $veiculo;
        } else {
            $this->Veiculo = new Veiculo($this->db);
        }
    }

    public function catalogo() {
        $busca = $_GET['busca'] ?? '';
        $filtros = [
            'year' => $_GET['year'] ?? '',
            'km_max' => $_GET['km_max'] ?? '',
            'cor' => $_GET['cor'] ?? '',
            'motor' => $_GET['motor'] ?? '',
            'cambio' => $_GET['cambio'] ?? '',
            'ar' => $_GET['ar'] ?? '',
            'valor_max' => $_GET['valor_max'] ?? '',
            'ordem' => $_GET['ordem'] ?? 'menor'
        ];
        $lista = $this->Veiculo->listarPublico ($busca, $filtros);
        $opcoes = $this->Veiculo->buscarOpcoesFiltros();
        if (file_exists('view/catalogo.php')) {
            include 'view/catalogo.php';
        }
    }

    public function detalhes() {
        $veiculo = $this->Veiculo->buscarPorId($_GET['id'] ?? 0);
        if (!$veiculo || !$veiculo['visivel']) {
            $this->redirecionar("index.php");
            return;
        }
        if (file_exists('view/detalhes.php')) {
            include 'view/detalhes.php';
        }
    }

    public function carrinho() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        if (isset($_GET['add'])) {
            $id = (int)$_GET['add'];
            if (!in_array($id, $_SESSION['carrinho'])) {
                $_SESSION['carrinho'][] = $id;
            }
            $this->redirecionar("index.php?action=carrinho");
            return;
        }
        if (isset($_GET['remove'])) {
            $id = (int)$_GET['remove'];
            $_SESSION['carrinho'] = array_diff($_SESSION['carrinho'], [$id]);
            $this->redirecionar("index.php?action=carrinho");
            return;
        }
        $itens = [];
        foreach ($_SESSION['carrinho'] as $id) {
            $item = $this->Veiculo->buscarPorId($id);
            if ($item) {
                $itens[] = $item;
            }
        }
        if (file_exists('view/carrinho.php')) {
            include 'view/carrinho.php';
        }
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if (isset($_SESSION['admin_logged'])) {
            $this->redirecionar("index.php?action=admin_dashboard");
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $stmt = $this->db->prepare("SELECT * FROM administradores WHERE usuario = :u AND senha = :s");
            $stmt->execute([':u' => $_POST['usuario'], ':s' => md5($_POST['senha'])]);
            if ($stmt->fetch()) {
                $_SESSION['admin_logged'] = true;
                $this->redirecionar("index.php?action=admin_dashboard");
                return;
            }
            $erro = "Credenciais incorretas.";
        }
        if (file_exists('view/admin_login.php')) {
            include 'view/admin_login.php';
        }
    }

    public function adminDashboard() {
        $this->verificarAcesso();
        $lista = $this->Veiculo->listarTodosAdmin();
        if (file_exists('view/admin_dashboard.php')) {
            include 'view/admin_dashboard.php';
        }
    }

    public function adminForm() {
        $this->verificarAcesso();
        $veiculo = null;
        if (isset($_GET['id'])) {
            $veiculo = $this->Veiculo->buscarPorId($_GET['id']);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = [
                'marca' => $_POST['marca'],
                'modelo' => $_POST['modelo'],
                'year' => (int)$_POST['year'],
                'km' => (int)$_POST['kilometragem'],
                'cor' => $_POST['cor'],
                'motor' => $_POST['motor'],
                'cambio' => $_POST['cambio'],
                'ar' => isset($_POST['ar_condicionado']) ? 1 : 0,
                'valor' => $_POST['valor'],
                'status' => $_POST['status'],
                'visivel' => isset($_POST['visivel']) ? 1 : 0
            ];
            if (!empty($_FILES['imagem']['name'])) {
                $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $nomeImg = time() . '_' . uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeImg);
                $dados['imagem'] = $nomeImg;
            } elseif (!isset($_GET['id'])) {
                $dados['imagem'] = 'sem-foto.png';
            }
            if (isset($_GET['id'])) {
                $dados['id'] = (int)$_GET['id'];
            }
            if ($this->Veiculo->salvar($dados)) {
                $this->redirecionar("index.php?action=admin_dashboard");
                return;
            }
        }
        if (file_exists('view/admin_form.php')) {
            include 'view/admin_form.php';
        }
    }

    public function adminExcluir() {
        $this->verificarAcesso();
        if (isset($_GET['id'])) {
            $this->Veiculo->excluir((int)$_GET['id']);
        }
        $this->redirecionar("index.php?action=admin_dashboard");
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        $_SESSION = [];
        @session_destroy();
        $this->redirecionar("index.php");
    }
    protected function verificarAcesso() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if (!isset($_SESSION['admin_logged'])) {
            $this->redirecionar("index.php?action=login");
        }
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