<?php

$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    fwrite(STDERR, "Error: falta vendor/autoload.php. Ejecutá 'composer install'.\n");
    exit(1);
}

require $autoloadPath;

use App\CircularWordChain;
use App\FileHandler;
use Throwable;

$projectRoot = __DIR__;
$inputPath = resolvePath($argv[1] ?? null, $projectRoot . '/input.txt', $projectRoot);
$outputPath = resolvePath($argv[2] ?? null, $projectRoot . '/output.txt', $projectRoot);
$fileHandler = new FileHandler();
$solver = new CircularWordChain();

try {
    $words = $fileHandler->read($inputPath);

    if (empty($words) || count($words) <= 1) {
        fwrite(STDOUT, "No se encontró una cadena circular. Archivo de salida (%s) vacío.\n", $outputPath);
        exit(0);
    }
    $chain = $solver->build($words);

    $fileHandler->write($outputPath, $chain);

    if ($chain === []) {
        fwrite(STDOUT, sprintf(
            "No se encontró una cadena circular. Archivo de salida (%s) vacío.\n",
            $outputPath
        ));
    } else {
        fwrite(STDOUT, "Cadena circular encontrada:\n");
        fwrite(STDOUT, implode(PHP_EOL, $chain) . PHP_EOL);
        fwrite(STDOUT, sprintf("Resultado guardado en %s\n", $outputPath));
    }
} catch (Throwable $exception) {
    fwrite(STDERR, 'Error: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}
exit(0);

function resolvePath(?string $argument, string $default, string $baseDir): string
{
    if ($argument === null || $argument === '') {
        return $default;
    }

    if ($argument[0] === DIRECTORY_SEPARATOR) {
        return $argument;
    }

    return $baseDir . '/' . ltrim($argument, '/');
}
