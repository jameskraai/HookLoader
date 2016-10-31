<?php

namespace JKraai\Hook;

use RuntimeException;
use InvalidArgumentException;

/**
 * A Hook should have a unique name and a callback assigned to it. As well as
 * other properties required by WordPress.
 */
interface HookType
{
    /**
     * Set the name of this Hook.
     *
     * @param string $name Name of this Hook.
     *
     * @throws InvalidArgumentException Thrown if the argument is not a string.
     * @return $this
     */
    public function setName($name);

    /**
     * Retrieve the name of this Hook.
     *
     * @throws RuntimeException If the name has not been set.
     * @return string
     */
    public function getName();

    /**
     * Set the callback which will be ran when this Hook is called.
     *
     * @param callable $callback Ran when this Hook is called.
     *
     * @return callable
     */
    public function setCallback($callback);

    /**
     * Retrieve the callback.
     *
     * @throws RuntimeException Should the callback not be set.
     * @return callable
     */
    public function getCallback();

    /**
     * Set the priority that this Hook has. It's up to
     * WordPress to respect this.
     *
     * @param int $priority Value of the priority.
     *
     * @throws InvalidArgumentException If the argument was not an int.
     * @return $this
     */
    public function setPriority($priority);

    /**
     * Retrieve the priority. I am aware the the native WordPress function has
     * a default value however an implementing class is not
     * responsible for that.
     *
     * @throws RuntimeException If the priority is not set.
     * @return int
     */
    public function getPriority();

    /**
     * Define the number of parameters that the callback can expect to be
     * passed to it.
     *
     * @param int $number Expected number of parameters.
     *
     * @throws InvalidArgumentException If the number was not an int.
     * @return $this
     */
    public function setNumberOfParameters($number);

    /**
     * Retrieve the number of parameters.
     *
     * @throws RuntimeException If the number of parameters has not been set.
     * @return int
     */
    public function getNumberOfParameters();
}
