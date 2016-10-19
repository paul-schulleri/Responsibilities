<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities;

use OutOfBoundsException;
use Schulleri\Responsibilities\Contracts\HandlerContract;
use Schulleri\Responsibilities\Helper\HandlerBuilder;
use ReflectionClass;

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
     * @param string $subject
     * @return mixed|null
     */
    final public function handle(string $subject)
    {
        $processed = $this->processing($subject);

        if ($processed === null && $this->successor !== null) {
            $processed = $this->successor->handle($subject);
        }

        return $processed;
    }

    /**
     * @param string $subject
     * @return mixed|null
     */
    final protected function processing(string $subject)
    {
        if ($this->currentHandlerName() === $subject) {
            return $this->execute();
        }

        return null;
    }

    /**
     * @return string
     */
    private function currentHandlerName():string
    {
        return strtolower(
            (new ReflectionClass(get_called_class()))->getShortName()
        );
    }

    /**
     * @return mixed
     */
    protected abstract function execute();
}
