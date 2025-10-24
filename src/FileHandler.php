<?php
namespace App;
use RuntimeException;

/**
 * Maneja la lectura y escritura de archivos de entrada/salida.
 */
class FileHandler
{
    /**
     * @return string[]
     */
    public function read(string $path): array
    {
        if (!is_file($path)) {
            throw new RuntimeException(sprintf('El archivo de entrada "%s" no existe.', $path));
        }

        $contents = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        return $contents === false ? [] : $contents;
    }

    /**
     * @param string[] $words
     */
    public function write(string $path, array $words): void
    {
        $data = $words === [] ? '' : implode(PHP_EOL, $words) . PHP_EOL;
        if (file_put_contents($path, $data) === false) {
            throw new RuntimeException(sprintf('No se pudo escribir en "%s".', $path));
        }
    }
}
