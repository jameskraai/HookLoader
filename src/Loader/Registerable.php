<?php

namespace JKraai\Hook;

/**
 * The purpose of an implementing class is to provide a single API of which
 * to register hooks and any other item with WordPress.
 */
interface Registerable
{
    /**
     * Registers the appropriate items such as hooks with WordPress.
     *
     * @return $this
     */
    public function register();
}
