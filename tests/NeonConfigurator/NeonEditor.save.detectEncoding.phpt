<?php

namespace Instante\NeonConfigurator\Tests;

use Instante\NeonConfigurator\NeonEditor;
use Instante\Tests\TestBootstrap;
use Tester\Assert;

require_once '../bootstrap.php';

$testNeonFile = TestBootstrap::$tempDir . '/' . basename(__FILE__) . '.neon';
$sampleTabs = __DIR__ . '/sample-tabs.neon';

copy($sampleTabs, $testNeonFile);

$ne = new NeonEditor($testNeonFile);
$ne->save();
unset($ne);
Assert::matchFile($sampleTabs, file_get_contents($testNeonFile));

$sample3spaces = __DIR__ . '/sample-3spaces.neon';

copy($sample3spaces, $testNeonFile);

$ne = new NeonEditor($testNeonFile);
$ne->save();
unset($ne);
Assert::matchFile($sample3spaces, file_get_contents($testNeonFile));
