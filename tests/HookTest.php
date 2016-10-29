<?php

namespace JKraai\Hook\Tests;

use Closure;
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

        $this->assertInstanceOf(Hook::class, $hook->setName("Valid name"));
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

        $callback = $this->makeCallback();

        $this->assertInstanceOf(Hook::class, $hook->setCallback($callback));
    }

    /**
     * Test that we are able to retrieve the callable callback when it's set.
     *
     * @covers \JKraai\Hook\Hook::getCallback
     */
    public function testGetCallbackReturnsCallable()
    {
        $hook = $this->getHook();

        $hook->setCallback($this->makeCallback());

        $this->assertInstanceOf(Closure::class, $hook->getCallback());
    }

    /**
     * Test that trying to retrieve the callback before it's been set
     * will raise an error.
     *
     * @expectedException RuntimeException
     * @covers \JKraai\Hook\Hook::getCallback
     */
    public function testGetCallbackPriorToSetRaisesError()
    {
        $hook = $this->getHook();

        $hook->getCallback();
    }

    /**
     * Test that we are able to set a valid priority.
     *
     * @covers \JKraai\Hook\Hook::setPriority
     */
    public function testAbleToSetValidPriority()
    {
        $hook = $this->getHook();

        $this->assertInstanceOf(Hook::class, $hook->setPriority(1));
    }

    /**
     * Test that setting an invalid priority will raise an error.
     *
     * @expectedException InvalidArgumentException
     * @covers \JKraai\Hook\Hook::setPriority
     * @covers \JKraai\Hook\Hook::invalidTypeMessage
     */
    public function testSettingInvalidPriorityRaisesError()
    {
        $hook = $this->getHook();

        $hook->setPriority("1");
    }

    /**
     * Test that we are able to get the priority once it's been set.
     *
     * @covers \JKraai\Hook\Hook::getPriority
     */
    public function testGetPriorityThatIsset()
    {
        $hook = $this->getHook();

        $hook->setPriority(1);

        $this->assertInternalType('int', $hook->getPriority());
    }

    /**
     * Test that trying to get the priority before it's been set will raise
     * an error.
     *
     * @expectedException RuntimeException
     * @covers \JKraai\Hook\Hook::getPriority
     * @covers \JKraai\Hook\Hook::propertyNotSetMessage
     */
    public function testGetPriorityBeforeSetRaisesError()
    {
        $hook = $this->getHook();

        $hook->getPriority();
    }

    /**
     * Test that we are able to set a valid number of parameters.
     *
     * @covers \JKraai\Hook\Hook::setNumberOfParameters
     */
    public function testSetValidNumberOfParameters()
    {
        $hook = $this->getHook();

        $this->assertInstanceOf(Hook::class, $hook->setNumberOfParameters(1));
    }

    /**
     * Test that trying to set the method with an invalid type
     * will raise an error.
     *
     * @expectedException InvalidArgumentException
     * @covers \JKraai\Hook\Hook::setNumberOfParameters
     */
    public function testSettingInvalidNumberOfParametersRaisesError()
    {
        $hook = $this->getHook();

        $hook->setNumberOfParameters("1");
    }

    /**
     * Test that we are able to retrieve the number of parameters
     * once it has been set.
     *
     * @covers \JKraai\Hook\Hook::getNumberOfParameters
     */
    public function testGetNumberOfParametersThatIsset()
    {
        $hook = $this->getHook();

        $hook->setNumberOfParameters(1);

        $this->assertInternalType('int', $hook->getNumberOfParameters());
    }

    /**
     * Test that trying to get the number of parameters prior
     * to being set will raise an error.
     *
     * @expectedException RuntimeException
     * @covers \JKraai\Hook\Hook::getNumberOfParameters
     */
    public function testGetNumberOfParamsPriorToSetRaisesError()
    {
        $hook = $this->getHook();

        $hook->getNumberOfParameters();
    }

    /**
     * Test that we are able to clone the Hook class.
     *
     * @covers \JKraai\Hook\Hook::__clone
     */
    public function testIsCloneable()
    {
        $hook = $this->getHook();

        $clonedHook = clone $hook;

        $this->assertInstanceOf(Hook::class, $clonedHook);
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
     * Returns an anonymous function we can use for testing.
     *
     * @return Closure
     */
    protected function makeCallback()
    {
        $callback = function () {
            // callable
        };

        return $callback;
    }
}
