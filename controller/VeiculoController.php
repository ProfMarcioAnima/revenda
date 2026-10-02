<?php
namespace App\Controller;
use App\Config\Conexao;
use App\Model\Veiculo;
use PDO;
class VeiculoController {
    private $Veiculo;
    public function __construct() {
        $db = (new Conexao())->getConnection();
        $this->Veiculo = new Veiculo($db);
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
        $lista = $this->Veiculo->listarPublico($busca, $filtros);
        $opcoes = $this->Veiculo->buscarOpcoesFiltros();
        include 'view/catalogo.php';
    }
    public function detalhes() {
        $veiculo = $this->Veiculo->buscarPorId($_GET['id'] ?? 0);
        if (!$veiculo || !$veiculo['visivel']) {
            header("Location: index.php");
            exit;
        }
        include 'view/detalhes.php';
    }
    public function carrinho() {
        if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];
        if (isset($_GET['add'])) {
            $id = (int)$_GET['add'];
            if (!in_array($id, $_SESSION['carrinho'])) $_SESSION['carrinho'][] = $id;
            header("Location: index.php?action=carrinho");
            exit;
        }
        if (isset($_GET['remove'])) {
            $id = (int)$_GET['remove'];
            $_SESSION['carrinho'] = array_diff($_SESSION['carrinho'], [$id]);
            header("Location: index.php?action=carrinho");
            exit;
        }
        $itens = [];
        foreach ($_SESSION['carrinho'] as $id) {
            $item = $this->Veiculo->buscarPorId($id);
            if ($item) $itens[] = $item;
        }
        include 'view/carrinho.php';
    }
    public function login() {
        if (isset($_SESSION['admin_logged'])) {
            header("Location: index.php?action=admin_dashboard");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = (new Conexao())->getConnection();
            $stmt = $db->prepare("SELECT * FROM administradores WHERE usuario = :u AND senha = :s");
            $stmt->execute([':u' => $_POST['usuario'], ':s' => md5($_POST['senha'])]);
            if ($stmt->fetch()) {
                $_SESSION['admin_logged'] = true;
                header("Location: index.php?action=admin_dashboard");
                exit;
            }
            $erro = "Credenciais incorretas.";
        }
        include 'view/admin_login.php';
    }
    public function adminDashboard() {
        $this->verificarAcesso();
        $lista = $this->Veiculo->listarTodosAdmin();
        include 'view/admin_dashboard.php';
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
                header("Location: index.php?action=admin_dashboard");
                exit;
            }
        }
        include 'view/admin_form.php';
    }
    public function adminExcluir() {
        $this->verificarAcesso();
        if (isset($_GET['id'])) $this->Veiculo->excluir((int)$_GET['id']);
        header("Location: index.php?action=admin_dashboard");
        exit;
    }
    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
    private function verificarAcesso() {
        if (!isset($_SESSION['admin_logged'])) {
            header("Location: index.php?action=login");
            exit;
        }
    }
}
