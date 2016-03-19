<?php

namespace Standard\Abstracts;

use Psr\Log\LoggerInterface;
use Tamtamchik\SimpleFlash\Flash;

abstract class ApiController
{
    /**
     * @Inject("site-config")
     * @var array
     */
    protected $site;

    /**
     * @Inject
     * @var LoggerInterface
     */
    protected $logger;

    protected function respond($data)
    {
        header('Content-Type: application/json');
        die(json_encode($data));
    }
}