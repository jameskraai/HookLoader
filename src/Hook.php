<?php

namespace JKraai\Hook;

use RuntimeException;
use InvalidArgumentException;

/**
 * Class Hook
 * A Hook can be either an Action or a Filter Hook. As far as our Loader is
 * concerned it is merely a "Hook".
 */
class Hook implements HookType, Cloneable
{
    /**
     * Name of the Hook we would like to reference.
     *
     * @var string
     */
    protected $name;

    /**
     * Callback to run when this Hook is called by WordPress.
     *
     * @var callable
     */
    protected $callback;

    /**
     * Desires priority of this callback, it is up
     * to WordPress to respect this.
     *
     * @var integer
     */
    protected $priority;

    /**
     * Number of parameters our callback can expect.
     *
     * @var integer
     */
    protected $numberOfParameters;

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;

            return $this;
        }

        $errorMessage = $this->invalidTypeMessage("string", $name);

        throw new InvalidArgumentException($errorMessage);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        if (is_string($this->name)) {
            return $this->name;
        }

        $errorMessage = $this->propertyNotSetMessage("name");

        throw new RuntimeException($errorMessage);
    }

    /**
     * {@inheritdoc}
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCallback()
    {
        if (is_callable($this->callback)) {
            return $this->callback;
        }

        $errorMessage = $this->propertyNotSetMessage("callback");

        throw new RuntimeException($errorMessage);
    }

    /**
     * {@inheritdoc}
     */
    public function setPriority($priority)
    {
        if (is_int($priority)) {
            $this->priority = $priority;

            return $this;
        }

        $errorMessage = $this->invalidTypeMessage("integer", $priority);

        throw new InvalidArgumentException($errorMessage);
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        if (is_int($this->priority)) {
            return $this->priority;
        }

        $errorMessage = $this->propertyNotSetMessage("priority");

        throw new RuntimeException($errorMessage);
    }

    /**
     * {@inheritdoc}
     */
    public function setNumberOfParameters($number)
    {
        if (is_int($number)) {
            $this->numberOfParameters = $number;

            return $this;
        }

        $errorMessage = $this->invalidTypeMessage("integer", $number);

        throw new InvalidArgumentException($errorMessage);
    }

    /**
     * {@inheritdoc}
     */
    public function getNumberOfParameters()
    {
        if (is_int($this->numberOfParameters)) {
            return $this->numberOfParameters;
        }

        $errorMessage = $this->propertyNotSetMessage("numberOfParameters");

        throw new RuntimeException($errorMessage);
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
        return new static();
    }

    /**
     * Convenience method for generating error messages when we are trying to
     * set a property of this class of a type we were not expecting.
     *
     * @param string $type     The type we were expecting.
     * @param mixed  $received What we received.
     *
     * @return string
     */
    protected function invalidTypeMessage($type, $received)
    {
        return "Received non-{$type} type: {$received}";
    }

    /**
     * Convenience method for generating error messages when we are trying to
     * retrieve a property that has not been set.
     *
     * @param string $property Property that hasn't been set.
     *
     * @return string
     */
    protected function propertyNotSetMessage($property)
    {
        return "Cannot return {$property} as it has not been set.";
    }
}
