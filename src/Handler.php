<?php
namespace Schulleri\Responsibilities;

use OutOfBoundsException;
use Schulleri\Responsibilities\Contracts\HandlerContract;
use Schulleri\Responsibilities\Helper\HandlerBuilder;

/**
 * Class Handler
 * @package Schulleri\Responsibilities
 */
abstract class Handler implements HandlerContract
{
    /** @var Handler */
    private $successor;

    /**
     * Handler constructor.
     * @param array $handlers
     * @param HandlerBuilder $handlerBuilder
     * @throws OutOfBoundsException
     */
    public function __construct(array $handlers, HandlerBuilder $handlerBuilder)
    {
        if ($handlers) {
            $this->successor = $handlerBuilder->build($handlers);
        }
    }

    /**
     * @param $reference
     * @return mixed|null
     */
    final public function handle($reference)
    {
        $processed = $this->processing($reference);

        if ($processed === null && $this->successor !== null) {
            $processed = $this->successor->handle($reference);
        }

        return $processed;
    }

    /**
     * @param $reference
     * @return mixed|null
     */
    final protected function processing($reference)
    {
        return $this->execute($reference) ?: null;
    }

    /**
     * @param $reference
     * @return mixed
     */
    protected abstract function execute($reference);
}
