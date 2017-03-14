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
$ne->setByKey('foo.bar.baz', 'newValue');
$ne->setByKey('foo.bar.lorem.ipsum', 'dolor');
$ne->setByKey('dolor', 'sit');
$ne->save();
unset($ne);
Assert::matchFile(__DIR__ . '/setByKey.expected.neon', file_get_contents($testNeonFile));
