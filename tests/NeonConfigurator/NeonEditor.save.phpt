<?php

namespace Instante\NeonConfigurator\Tests;

use Instante\NeonConfigurator\NeonEditor;
use Instante\Tests\TestBootstrap;
use Tester\Assert;

require_once '../bootstrap.php';

$testNeonFile = TestBootstrap::$tempDir . '/' . basename(__FILE__) . '.neon';
$sample = __DIR__ . '/sample.neon';

copy($sample, $testNeonFile);

$ne = new NeonEditor($testNeonFile);
$ne->save();
unset($ne);
Assert::matchFile($sample, file_get_contents($testNeonFile));
