<?php
namespace Schulleri\Responsibilities;

use InvalidArgumentException;
use OutOfBoundsException;
use Schulleri\Responsibilities\Contracts\AssemblerContract;
use Schulleri\Responsibilities\Helper\HandlerBuilder;
use Schulleri\Responsibilities\Helper\HandlerList;

/**
 * Class Assembler
 * @package Schulleri\Responsibilities
 */
class Assembler implements AssemblerContract
{
    /** @var HandlerBuilder */
    private $handlerBuilder;

    /** @var HandlerList */
    private $handlerList;

    /**
     * Assembler constructor.
     * @param HandlerBuilder $handlerBuilder
     * @param HandlerList $handlerList
     */
    public function __construct(
        HandlerBuilder $handlerBuilder,
        HandlerList $handlerList
    ) {
        $this->handlerBuilder = $handlerBuilder;
        $this->handlerList = $handlerList;
    }

    /**
     * @param $reference
     * @param string $subset
     * @return mixed
     * @throws OutOfBoundsException
     * @throws InvalidArgumentException
     */
    public function run($reference, string $subset)
    {
        $handlerList = $this->handlerList->get($subset);
        $handler = $this->handlerBuilder->build($handlerList);

        return $handler->handle($reference);
    }
}
