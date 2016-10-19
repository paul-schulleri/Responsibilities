<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities;

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
     * @param string $subject
     * @param string
     * @throws OutOfBoundsException
     * @return mixed
     */
    public function run(string $subject, string $subset)
    {
        $handlerList = $this->handlerList->get($subset);
        $handler = $this->handlerBuilder->build($handlerList);

        return $handler->handle($subject);
    }
}
