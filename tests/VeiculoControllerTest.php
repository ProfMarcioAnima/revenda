<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\VeiculoController;
use App\Model\Veiculo;
use PDO;

class VeiculoControllerTest extends TestCase
{
    private $veiculoMock;
    private $dbMock;
    private $controller;

    protected function setUp(): void
    {
        ob_start();
        $this->veiculoMock = $this->createStub(Veiculo::class);
        $this->dbMock = $this->createStub(PDO::class);
        $this->controller = new VeiculoController($this->veiculoMock, $this->dbMock);
    }

    protected function tearDown(): void
    {
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
    }

    public function testControllerPodeSerInstanciado()
    {
        $this->assertInstanceOf(
            VeiculoController::class,
            $this->controller,
            'A classe VeiculoController não pôde ser instanciada corretamente.'
        );
    }

    public function testAdicionarERemoverItemDoCarrinhoViaSessao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }

        $_GET['add'] = 10;
        $this->controller->carrinho();
        $this->assertContains(
            10,
            $_SESSION['carrinho'],
            'O item não foi adicionado ao carrinho na sessão.'
        );

        $_GET = [];
        $_GET['remove'] = 10;
        $this->controller->carrinho();
        $this->assertNotContains(
            10,
            $_SESSION['carrinho'],
            'O item não foi removido do carrinho na sessão.'
        );
    }

    public function testLogoutLimpaSessao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        $_SESSION['admin_logged'] = true;

        $this->controller->logout();

        $this->assertArrayNotHasKey(
            'admin_logged',
            $_SESSION,
            'O logout não limpou a chave de sessão admin_logged.'
        );
    }
}