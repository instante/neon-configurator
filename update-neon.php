<?php

use Instante\NeonConfigurator\NeonEditor;

require __DIR__ . '/autoload.php';

if (count($argv) < 4) {
    echo <<<EOT
Usage:
./update-neon path-to-file.neon update.key updateValue
EOT;
    die;
}
$pathToNeon = $argv[1];
$key = $argv[2];
$value = $argv[3];
if (!file_exists($argv[1])) {
    echo "File {$argv[1]} not found.";
    die(255);
}

$neonEditor = new NeonEditor($pathToNeon);
$neonEditor->setByKey($key, $value);
$neonEditor->save();
printf('%s: "%s" set to "%s"%s', basename($pathToNeon), $key, $value, PHP_EOL);
