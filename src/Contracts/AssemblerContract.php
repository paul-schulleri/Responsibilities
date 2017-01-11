<?php
namespace Schulleri\Responsibilities\Contracts;

/**
 * Interface AssemblerContract
 * @package Schulleri\Responsibilities\Contracts
 */
interface AssemblerContract
{
    /**
     * @param string $key
     * @param string $subset
     * @return mixed
     */
    public function run(string $key, string $subset);
}
