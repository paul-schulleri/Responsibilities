<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities\Contracts;

/**
 * Interface AssemblerContract
 * @package Schulleri\Responsibilities\Contracts
 */
interface AssemblerContract
{
    /**
     * @param string $subject
     * @param string $subset
     * @return mixed
     */
    public function run(string $subject, string $subset);
}
