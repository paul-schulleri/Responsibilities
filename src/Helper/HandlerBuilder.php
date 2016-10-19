<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities\Helper;

use Schulleri\Responsibilities\Contracts\HandlerContract;
use OutOfBoundsException;

/**
 * Class HandlerBuilder
 * @package Schulleri\Responsibilities\Helper
 */
class HandlerBuilder
{
    /**
     * @param array $handlerList
     * @return HandlerContract
     * @throws OutOfBoundsException
     */
    public function build(array $handlerList):HandlerContract
    {
        $handler = array_shift($handlerList);

        if ($handler !== null && class_exists($handler)) {
            return new $handler($handlerList, $this);
        }

        throw new OutOfBoundsException('Ops, could not build class');
    }
}
