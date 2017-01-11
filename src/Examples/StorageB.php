<?php
namespace Schulleri\Responsibilities\Examples;

use Schulleri\Responsibilities\Handler;

/**
 * Class StorageB
 * @package Schulleri\Responsibilities\Examples
 */
class StorageB extends Handler
{
    /** @var array */
    private $data = [
        'da4b' => 'paul'
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
