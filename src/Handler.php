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
     * @param string $key
     * @return mixed|null
     */
    final public function handle(string $key)
    {
        $processed = $this->processing($key);

        if ($processed === null && $this->successor !== null) {
            $processed = $this->successor->handle($key);
        }

        return $processed;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    final protected function processing(string $key)
    {
        return $this->execute($key) ?: null;
    }

    /**
     * @param $key
     * @return mixed
     */
    protected abstract function execute($key);
}
