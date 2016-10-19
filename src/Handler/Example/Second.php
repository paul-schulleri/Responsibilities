<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities\Handler\Channels;

use Schulleri\Responsibilities\Handler;

/**
 * Class Second
 * @package Schulleri\Responsibilities\Handler\Channels
 */
class Second extends Handler
{
    /**
     * @return array
     */
    protected function execute()
    {
        return 'Executing Second';
    }
}
