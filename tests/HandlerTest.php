<?php
namespace Schulleri\Responsibilities;

use PHPUnit\Framework\TestCase;
use Schulleri\Responsibilities\Helper\HandlerBuilder;
use Schulleri\Responsibilities\Helper\HandlerList;

/**
 * Class HandlerTest
 * @package Schulleri\Responsibilities
 */
class HandlerTest extends TestCase
{
    /**
     *
     */
    public function testDefault()
    {
        $builder = new HandlerBuilder();
        $handlerList = new HandlerList();

        $assembler = new Assembler(
            $builder, $handlerList
        );

        $exampleNamespace = 'Schulleri\\Responsibilities\\Examples';

        $this->assertEquals(
            'peter', $assembler->run('356a', $exampleNamespace)
        );
    }

    /**
     *
     */
    public function testDirectoryOverwrite()
    {
        $builder = new HandlerBuilder();
        $handlerList = new HandlerList();

        $assembler = new Assembler(
            $builder, $handlerList
        );

        $assembler->setHandlerListDirectory(__DIR__ . '/../');

        $exampleNamespace = 'Schulleri\\Responsibilities\\Examples';

        $this->assertEquals(
            'peter', $assembler->run('356a', $exampleNamespace)
        );
    }
}
