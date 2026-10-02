<?php

use PHPUnit\Framework\TestCase;

class NomenclaturaTest extends TestCase
{
    public function testMetodosDevemUsarCamelCase(): void
    {
        $classesDesejadas = ['VeiculoController', 'Veiculo'];
        $infracoes = [];

        foreach ($classesDesejadas as $nomeCurto) {
            $classeEncontrada = $this->resolverECarregarClasse($nomeCurto);

            if (!$classeEncontrada) {
                $this->fail("A classe '{$nomeCurto}' não foi encontrada pelo autoloader do Composer.");
            }

            $reflection = new ReflectionClass($classeEncontrada);
            $metodos = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

            foreach ($metodos as $metodo) {
                if ($metodo->getDeclaringClass()->getName() !== $reflection->getName()) {
                    continue;
                }

                if (str_starts_with($metodo->getName(), '__')) {
                    continue;
                }

                if (str_contains($metodo->getName(), '_')) {
                    $infracoes[] = "{$reflection->getShortName()}: método '{$metodo->getName()}'";
                }
            }
        }

        if (!empty($infracoes)) {
            $this->fail(
                "Violação PSR-12 / camelCase não encontrada:\n- " . implode("\n- ", $infracoes)
            );
        }

        $this->assertTrue(true);
    }

    private function resolverECarregarClasse(string $nomeCurto): ?string
    {
        foreach (spl_autoload_functions() as $autoloader) {
            if (is_array($autoloader) && $autoloader[0] instanceof \Composer\Autoload\ClassLoader) {
                $loader = $autoloader[0];

                $prefixesPsr4 = $loader->getPrefixesPsr4();
                foreach ($prefixesPsr4 as $prefixo => $pastas) {
                    $subnamespaces = ['', 'Controllers\\', 'Models\\', 'Controller\\', 'Model\\'];
                    foreach ($subnamespaces as $sub) {
                        $fqcnCandidato = $prefixo . $sub . $nomeCurto;
                        if ($loader->findFile($fqcnCandidato)) {
                            class_exists($fqcnCandidato);
                            return $fqcnCandidato;
                        }
                    }
                }

                $mapa = $loader->getClassMap();
                foreach ($mapa as $fqcn => $caminho) {
                    if (str_ends_with($fqcn, '\\' . $nomeCurto) || $fqcn === $nomeCurto) {
                        class_exists($fqcn);
                        return $fqcn;
                    }
                }
            }
        }

        if (class_exists($nomeCurto)) {
            return $nomeCurto;
        }

        return null;
    }
}