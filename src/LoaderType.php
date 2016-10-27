<?php

/**
 * An implementing type provides an api to add Action and Filter wordpress
 * hooks. The intention is that the added hooks will then be handled
 * by WordPress.
 */
interface LoaderType
{
    /**
     * Attach a callback to the named Action.
     *
     * @param string          $name              Name of the action hook.
     * @param callable|string $callback          Callback to be ran when this hook is called.
     * @param integer         $priority          Specifies order of execution for this callback.
     * @param integer         $numberOfArguments Number of arguments this callback expects.
     *
     * @return $this
     */
    public function addAction($name, $callback, $priority, $numberOfArguments);

    /**
     * Attach a callback to the named Filter.
     *
     * @param string          $name              Name of the filter hook.
     * @param callable|string $callback          Callback to be ran when this hook is called.
     * @param integer         $priority          Specifies order of execution for this callback.
     * @param integer         $numberOfArguments Number of arguments this callback expects.
     */
    public function addFilter($name, $callback, $priority, $numberOfArguments);
}
