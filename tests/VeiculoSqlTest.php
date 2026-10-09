<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Veiculo;
use ReflectionClass;

class VeiculoSqlTest extends TestCase
{
    public function testNaoExisteSelectAsteriscoNoModel()
    {
        $reflector = new ReflectionClass(Veiculo::class);
        $caminhoArquivo = $reflector->getFileName();
        $conteudo = file_get_contents($caminhoArquivo);

        $this->assertDoesNotMatchRegularExpression(
            '/SELECT[^\n]*\*/i',
            $conteudo,
            'Não é permitido usar * no SELECT do SQL no Model.'
        );
    }
}