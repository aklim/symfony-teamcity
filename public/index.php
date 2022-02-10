<?php
/**
 * @author Andrey Klimenko <andrey@cyberwrite.com>
 */

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    $env = (string) $context['APP_ENV'];

    return new Kernel($env, (bool) $context['APP_DEBUG']);
};
