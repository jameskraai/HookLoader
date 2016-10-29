<?php

namespace JKraai\Hook\Tests;

use Mockery;
use JKraai\Hook\Hook;
use JKraai\Hook\Factory;
use Mockery\MockInterface;
use JKraai\Hook\Cloneable;

/**
 * Test that the Hook Factory will clone our Hook and
 * return a new instance.
 */
class FactoryTest extends TestCase
{
    /**
     * Test that the make method will clone the Hook
     * we provided.
     *
     * @covers \JKraai\Hook\Factory::__construct
     * @covers \JKraai\Hook\Factory::make
     */
    public function testHookIsCloned()
    {
        $factory = $this->makeFactory();

        $this->assertInstanceOf(Cloneable::class, $factory->make());
    }

    /**
     * Make a new Factory instance for testing.
     *
     * @return Factory
     */
    protected function makeFactory()
    {
        $hook = $this->makeHook();

        return new Factory($hook);
    }

    /**
     * Make a mock cloneable Hook.
     *
     * @return MockInterface
     */
    protected function makeHook()
    {
        return Mockery::mock(Hook::class);
    }
}
