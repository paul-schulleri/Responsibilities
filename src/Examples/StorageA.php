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
     * @param $reference
     * @return array
     */
    protected function execute($reference)
    {
        if (array_key_exists($reference, $this->data)) {
            return $this->data[$reference];
        }

        return null;
    }
}
