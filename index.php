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
$action = $_GET['action'] ?? 'catalogo';
$controller = new VeiculoController();
switch ($action) {
    case 'catalogo': $controller->catalogo(); break;
    case 'detalhes': $controller->detalhes(); break;
    case 'carrinho': $controller->carrinho(); break;
    case 'login': $controller->login(); break;
    case 'admin_dashboard': $controller->adminDashboard(); break;
    case 'admin_form': $controller->adminForm(); break;
    case 'admin_excluir': $controller->adminExcluir(); break;
    case 'logout': $controller->logout(); break;
    default: $controller->catalogo(); break;
}
