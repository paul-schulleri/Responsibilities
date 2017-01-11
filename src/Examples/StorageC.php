<?php
namespace Schulleri\Responsibilities\Examples;

use Schulleri\Responsibilities\Handler;

/**
 * Class StorageC
 * @package Schulleri\Responsibilities\Examples
 */
class StorageC extends Handler
{
    /** @var array */
    private $data = [
        '77de' => 'patrick'
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
