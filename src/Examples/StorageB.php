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
