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
