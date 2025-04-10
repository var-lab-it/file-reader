<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/config/bootstrap.php')) {
    include dirname(__DIR__) . '/config/bootstrap.php';
}
