<?php

namespace Instante\NeonConfigurator\Tests;

use Instante\NeonConfigurator\NeonEditor;
use Instante\Tests\TestBootstrap;
use Tester\Assert;

require_once '../bootstrap.php';

$testNeonFile = TestBootstrap::$tempDir . '/' . basename(__FILE__) . '.neon';
file_put_contents($testNeonFile, '');

$ne = new NeonEditor($testNeonFile);
$ne->setByKey('integer', '123');
$ne->setByKey('string', '"123"');
$ne->setByKey('bool', 'true');
$ne->setByKey('null', 'null');
$ne->save();
unset($ne);
Assert::matchFile(__DIR__ . '/types.expected.neon', file_get_contents($testNeonFile));
