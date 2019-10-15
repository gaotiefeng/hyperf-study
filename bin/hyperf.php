#!/usr/bin/env php
<?php

use Hyperf\Contract\ApplicationInterface;
use Psr\Container\ContainerInterface;

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');

error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));
! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', SWOOLE_HOOK_ALL);

require BASE_PATH . '/vendor/autoload.php';

// Self-called anonymous function that creates its own scope and keep the global namespace clean.
(function () {
    /** @var ContainerInterface $container */
    $container = require BASE_PATH . '/config/container.php';

    $application = $container->get(ApplicationInterface::class);
    $application->run();
})();
