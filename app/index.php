<?php

declare(strict_types=1);

use RuntimeException;

require __DIR__.'/vendor/autoload.php';

return function ($event) {
    exec('php artisan aggregate:all', $output, $exit);
    var_dump($output);
    if($exit) {
        throw new RuntimeException('non-zero exit code');
    }

    return $exit;
};
