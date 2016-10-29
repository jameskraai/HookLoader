<?php

namespace JKraai\Hook;

/**
 * Interface Cloneable
 * An implementing class is able to be cloned.
 */
interface Cloneable
{
    /**
     * Clone and return a new instance.
     *
     * @return static
     */
    public function __clone();
}
