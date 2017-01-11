<?php
namespace Schulleri\Responsibilities\Contracts;

use Schulleri\Responsibilities\Helper\HandlerBuilder;

/**
 * Interface HandlerContract
 * @package Schulleri\Responsibilities
 */
interface HandlerContract
{
    /**
     * HandlerContract constructor.
     * @param array $handlers
     * @param HandlerBuilder $handlerBuilder
     */
    public function __construct(array $handlers, HandlerBuilder $handlerBuilder);

    /**
     * @param string $key
     * @return mixed
     */
    public function handle(string $key);
}
