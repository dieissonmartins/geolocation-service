<?php

namespace App\Jobs\Interfaces;

interface QueueJobInterface
{
    /**
     * @return array
     */
    public function _Debug(): array;

    /**
     * @param array $params
     * @return bool
     */
    public function _Validate(array $params): bool;

    /**
     * @param array $params
     * @return void
     */
    public function _Execute(array $params): void;
}
