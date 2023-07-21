<?php

namespace App\Bin\Jobs;

use App\Jobs\QueueJob;
use Exception;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

class Debug
{

    /**
     * @var array
     */
    private $argv;

    /**
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->argv = $args;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function execute(): void
    {
        $queue_job = new QueueJob($this->argv);

        $queue_job->handle();
    }

}

# start laravel
define('LARAVEL_START', microtime(true));


$app = require_once __DIR__.'/../../../bootstrap/app.php';

$app->run();

# parametros do comando
$argv = $_SERVER['argv'];

# nome do job
$class_name = $argv[1];

# array padao para depurar fila
$params = [
    'class_name' => $class_name,
    'params' => []
];

# nova depuracao
$debug = new Debug($params);

/** @var Exception $e */
try {
    # executa depuracao
    $debug->execute();
} catch (Exception $e) {
    throw new Exception($e);
}
