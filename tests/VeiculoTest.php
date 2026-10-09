<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Veiculo;
use PDO;
use PDOStatement;

class VeiculoTest extends TestCase
{
    private $dbMock;
    private $stmtMock;
    private $veiculo;

    protected function setUp(): void
    {
        $this->dbMock = $this->createStub(PDO::class);
        $this->stmtMock = $this->createStub(PDOStatement::class);
        $this->veiculo = new Veiculo($this->dbMock);
    }

    public function testVeiculoPodeSerInstanciado()
    {
        $this->assertInstanceOf(
            Veiculo::class,
            $this->veiculo,
            'A classe Veiculo não pôde ser instanciada corretamente.'
        );
    }

    public function testlistarPublico RetornaArray()
    {
        $this->dbMock->method('prepare')->willReturn($this->stmtMock);
        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetchAll')->willReturn([]);

        $resultado = $this->veiculo->listarPublico ();
        $this->assertIsArray(
            $resultado,
            'O método listarPublico  deve retornar um array.'
        );
    }

    public function testListarTodosAdminRetornaArray()
    {
        $this->dbMock->method('prepare')->willReturn($this->stmtMock);
        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetchAll')->willReturn([]);

        $resultado = $this->veiculo->listarTodosAdmin();
        $this->assertIsArray(
            $resultado,
            'O método listarTodosAdmin deve retornar um array.'
        );
    }

    public function testBuscarPorIdRetornaArrayQuandoEncontrar()
    {
        $this->dbMock->method('prepare')->willReturn($this->stmtMock);
        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetch')->willReturn(['id' => 1, 'marca' => 'Fiat', 'modelo' => 'Uno']);

        $resultado = $this->veiculo->buscarPorId(1);
        $this->assertIsArray(
            $resultado,
            'O método buscarPorId deve retornar um array quando o veículo for encontrado.'
        );
    }

    public function testBuscarPorIdRetornaFalsoQuandoInexistente()
    {
        $this->dbMock->method('prepare')->willReturn($this->stmtMock);
        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetch')->willReturn(false);

        $resultado = $this->veiculo->buscarPorId(999999);
        $this->assertFalse(
            $resultado,
            'O método buscarPorId deve retornar false quando o veículo não for encontrado.'
        );
    }

    public function testBuscaPorIdComCaracteresMaliciosos()
    {
        $this->dbMock->method('prepare')->willReturn($this->stmtMock);
        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetch')->willReturn(false);

        $resultado = $this->veiculo->buscarPorId("' OR 1=1 --");
        $this->assertFalse(
            $resultado,
            'O método buscarPorId deve retornar false ao receber tentativa de SQL Injection.'
        );
    }

    public function testSalvarNovoVeiculoRetornaBooleano()
    {
        $this->dbMock->method('prepare')->willReturn($this->stmtMock);
        $this->stmtMock->method('execute')->willReturn(true);

        $dados = [
            'marca' => 'Chevrolet',
            'modelo' => 'Onix',
            'year' => 2022,
            'km' => 15000,
            'cor' => 'Preto',
            'motor' => '1.0',
            'cambio' => 'Manual',
            'ar' => 1,
            'valor' => 50000,
            'imagem' => 'foto.jpg',
            'status' => 'disponivel',
            'visivel' => 1
        ];

        $resultado = $this->veiculo->salvar($dados);
        $this->assertTrue(
            $resultado,
            'O método salvar deve retornar o booleano true em caso de sucesso.'
        );
    }

    public function testExcluirVeiculoRetornaBooleano()
    {
        $this->dbMock->method('prepare')->willReturn($this->stmtMock);
        $this->stmtMock->method('execute')->willReturn(true);

        $resultado = $this->veiculo->excluir(1);
        $this->assertTrue(
            $resultado,
            'O método excluir deve retornar o booleano true em caso de sucesso.'
        );
    }

    public function testBuscarOpcoesFiltrosRetornaEstruturaCorreta()
    {
        $this->dbMock->method('query')->willReturn($this->stmtMock);
        $this->stmtMock->method('fetchAll')->willReturn([]);

        $resultado = $this->veiculo->buscarOpcoesFiltros();

        $this->assertIsArray(
            $resultado,
            'O método buscarOpcoesFiltros deve retornar um array.'
        );
        $this->assertArrayHasKey(
            'anos',
            $resultado,
            'A estrutura de filtros deve conter a chave "anos".'
        );
        $this->assertArrayHasKey(
            'cores',
            $resultado,
            'A estrutura de filtros deve conter a chave "cores".'
        );
        $this->assertArrayHasKey(
            'motores',
            $resultado,
            'A estrutura de filtros deve conter a chave "motores".'
        );
        $this->assertArrayHasKey(
            'cambios',
            $resultado,
            'A estrutura de filtros deve conter a chave "cambios".'
        );
    }
}