<?php

namespace JKraai\Hook\Tests;

use RuntimeException;
use JKraai\Hook\Hook;
use InvalidArgumentException;

/**
 * Unit tests for the Hook class.
 *
 * @see Hook
 */
class HookTest extends TestCase
{
    /**
     * Test that we are able to set a valid name on a Hook.
     *
     * @covers \JKraai\Hook\Hook::setName
     */
    public function testSettingValidName()
    {
        $hook = $this->getHook();

        $this->assertInstanceOf($this->getHookClass(), $hook->setName("Valid name"));
    }

    /**
     * Test that setting an invalid name on a Hook will raise an error.
     *
     * @expectedException InvalidArgumentException
     * @covers \JKraai\Hook\Hook::setName
     */
    public function testSettingInvalidNameRaisesError()
    {
        $hook = $this->getHook();

        $hook->setName(2);
    }

    /**
     * Test that we are able to retrieve the name of our Hook
     * assuming that it has been already set.
     *
     * @covers \JKraai\Hook\Hook::getName
     */
    public function testGetNameThatIsset()
    {
        $hook = $this->getHook();
        $hook->setName("Valid name");

        $this->assertInternalType('string', $hook->getName());
    }

    /**
     * Test that trying to get the name before it's been set on a Hook
     * will raise an error.
     *
     * @expectedException RuntimeException
     * @covers \JKraai\Hook\Hook::getName
     */
    public function testGetNamePriorToSetRaisesError()
    {
        $hook = $this->getHook();

        $hook->getName();
    }

    /**
     * Test that we are able to set a valid callback.
     *
     * @covers \JKraai\Hook\Hook::setCallback
     */
    public function testSettingValidCallback()
    {
        $hook = $this->getHook();

        $callback = function () {
            return true;
       };

       $this->assertInstanceOf($this->getHookClass(), $hook->setCallback($callback));
    }

    /**
     * Returns a new Hook instance for our tests.
     *
     * @return Hook
     */
    protected function getHook()
    {
        return new Hook();
    }

    /**
     * Retrieve the fully qualified class name of our Hook class. This is used
     * frequently by our tests that are fluent interfaces.
     *
     * @return string
     */
    protected function getHookClass()
    {
        return get_class($this->getHook());
    }
}
