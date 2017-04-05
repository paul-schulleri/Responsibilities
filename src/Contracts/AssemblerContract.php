<?php
namespace Schulleri\Responsibilities\Contracts;

/**
 * Interface AssemblerContract
 * @package Schulleri\Responsibilities\Contracts
 */
interface AssemblerContract
{
    /**
     * @param $reference
     * @param string $subset
     * @return mixed
     */
    public function run($reference, string $subset);

    /**
     * @param string $directory
     * @return AssemblerContract
     */
    public function setHandlerListDirectory(string $directory): AssemblerContract;
}
