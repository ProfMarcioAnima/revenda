<?php
session_start();

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $parts = explode('\\', $relative_class);
    if (count($parts) > 1) {
        $parts[0] = strtolower($parts[0]);
    }
    if (end($parts) === 'Conexao') {
        $file = $base_dir . 'config/conexao.php';
    } else {
        $file = $base_dir . implode('/', $parts) . '.php';
    }
    if (file_exists($file)) {
        require $file;
    }
});

use App\Controller\VeiculoController;
use App\Controller\UsuarioController;

$action = $_GET['action'] ?? 'catalogo';

switch ($action) {
    case 'catalogo':
        $controller = new VeiculoController();
        $controller->catalogo();
        break;
    case 'detalhes':
        $controller = new VeiculoController();
        $controller->detalhes();
        break;
    case 'carrinho':
        $controller = new VeiculoController();
        $controller->carrinho();
        break;
    case 'login':
        $userController = new UsuarioController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->logar();
        } else {
            if (file_exists('view/admin_login.php')) {
                include 'view/admin_login.php';
            }
        }
        break;
    case 'admin_dashboard':
        $controller = new VeiculoController();
        $controller->adminDashboard();
        break;
    case 'admin_form':
        $controller = new VeiculoController();
        $controller->adminForm();
        break;
    case 'admin_excluir':
        $controller = new VeiculoController();
        $controller->adminExcluir();
        break;
    case 'logout':
        $userController = new UsuarioController();
        $userController->sair();
        break;
    default:
        $controller = new VeiculoController();
        $controller->catalogo();
        break;
}