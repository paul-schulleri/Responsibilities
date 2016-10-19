<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities\Contracts;

use Schulleri\Responsibilities\Helper\HandlerBuilder;

/**
 * Interface HandlerContract
 * @package Schulleri\Responsibilities
 */
interface HandlerContract
{
    public function __construct(array $handlers, HandlerBuilder $handlerBuilder);

    /**
     * @param string $subject
     * @return mixed
     */
    public function handle(string $subject);
}
