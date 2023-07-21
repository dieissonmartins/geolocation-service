<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueueJob implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var string
     */
    protected $name_class;

    /**
     * @var array|mixed
     */
    protected $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $queue)
    {
        $this->name_class = $queue['class_name'];
        $this->params = $queue['params'];
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $class = "App\\Jobs\\Queue{$this->name_class}Job";

        # cria novo job com base nos parametros
        $job = new $class();

        # busca dados para depuracao local
        if (!$this->params) {
            $params = $job->_Debug();
        } else {
            $params = $this->params;
        }

        # valida campos
        $validate = $job->_Validate($params);
        if (!$validate) {
            throw new Exception('error by validate');
        }

        # executa metodo principal do job
        $job->_Execute($params);
    }
}
