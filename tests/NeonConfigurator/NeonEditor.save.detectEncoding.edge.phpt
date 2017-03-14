<?php

namespace Instante\NeonConfigurator\Tests;

use Instante\NeonConfigurator\NeonEditor;
use Instante\Tests\TestBootstrap;
use Tester\Assert;

require_once '../bootstrap.php';

$testNeonFile = TestBootstrap::$tempDir . '/' . basename(__FILE__) . '.neon';
$edge = __DIR__ . '/edge.neon';

copy($edge, $testNeonFile);

$ne = new NeonEditor($testNeonFile);
$ne->save();
unset($ne);
Assert::matchFile(__DIR__ . '/edge.expected.neon', file_get_contents($testNeonFile));
