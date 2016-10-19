<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities\Handler\Channels;

use Schulleri\Responsibilities\Handler;

/**
 * Class First
 * @package Schulleri\Responsibilities\Handler\Channels
 */
class First extends Handler
{
    /**
     * @return array
     */
    protected function execute()
    {
        return 'First';
    }
}
