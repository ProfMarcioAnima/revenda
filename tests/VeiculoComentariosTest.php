<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Veiculo;
use App\Controller\VeiculoController;
use ReflectionClass;

class VeiculoComentariosTest extends TestCase
{
    public function testNaoExisteComentarioBlocoMultilineNoModel()
    {
        $reflector = new ReflectionClass(Veiculo::class);
        $caminhoArquivo = $reflector->getFileName();
        $conteudo = file_get_contents($caminhoArquivo);

        $temComentario = preg_match('/\/\*[\s\S]*?\n[\s\S]*?\*\//', $conteudo);

        if ($temComentario) {
            $this->fail('Não é permitido usar comentários em bloco de múltiplas linhas no Model.');
        }

        $this->assertTrue(true);
    }

    public function testNaoExisteComentarioBlocoMultilineNoController()
    {
        $reflector = new ReflectionClass(VeiculoController::class);
        $caminhoArquivo = $reflector->getFileName();
        $conteudo = file_get_contents($caminhoArquivo);

        $temComentario = preg_match('/\/\*[\s\S]*?\n[\s\S]*?\*\//', $conteudo);

        if ($temComentario) {
            $this->fail('Não é permitido usar comentários em bloco de múltiplas linhas no Controller.');
        }

        $this->assertTrue(true);
    }
}