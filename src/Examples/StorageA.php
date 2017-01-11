<?php
namespace Schulleri\Responsibilities\Examples;

use Schulleri\Responsibilities\Handler;

/**
 * Class StorageA
 * @package Schulleri\Responsibilities\Examples
 */
class StorageA extends Handler
{
    /** @var array */
    private $data = [
        '356a' => 'peter'
    ];

    /**
     * @param $key
     * @return array
     */
    protected function execute($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }
}
