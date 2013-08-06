<?php
use Symfony\Component\Yaml\Exception\RuntimeException;

ini_set('error_reporting', E_ALL);
$files = array(__DIR__ . '/../vendor/autoload.php', __DIR__ . '/../../../autoload.php');
foreach ($files as $file) {
    if (file_exists($file)) {
        $loader = require $file;
        break;
    }
}
if (! isset($loader)) {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you install via composer?');
}
$loader->add('DigitalBeesSDKTest\\', __DIR__);

unset($file, $files, $loader);