<?php

namespace JKraai\Hook;

use JKraai\Hook\WordPressDelegate as WPDelegate;
/**
 * This implementation of these various interfaces create what I would consider
 * the "core" of a WordPress plugin. In that we are able to add any Action or
 * Filter Hooks to it and they will be then handled by WordPress.
 *
 * There is no magic here, basically what this implementation comes down to is
 * a fancy way of invoking the add_action and add_filter functions with our
 * supplied callbacks. But in reality it is much more, in that we are able
 * to reference our callbacks from a service container, a closure, good
 * old fashioned string function reference or what have you! Anything
 * is possible and you can be rest-assured that no matter what you
 * supply as a callback, it will be handled by WordPress.
 */
class Loader implements Hookable, Routable, Registerable
{
    /**
     * Action hooks that we have added. This will be an array
     * of HookType instances.
     *
     * @see HookType
     * @var array
     */
    protected $actions = array();

    /**
     * Filter hooks that have been added. This will also
     * be an array of HookType instances.
     *
     * @see HookType
     * @var array
     */
    protected $filters = array();

    /**
     * Factory that makes new Hooks. This is used when we add a new Action or
     * Filter Hook to this Loader.
     *
     * @var Factory
     */
    protected $hookFactory;

    /**
     * We are able to use this to delegate the task of making global function
     * calls to WordPress.
     *
     * @var WPDelegate
     */
    protected $wpDelegate;

    /**
     * Loader constructor.
     *
     * @param Factory $factory Factory for making new Hooks.
     */
    public function __construct(Factory $factory, WPDelegate $wpDelegate)
    {
        $this->hookFactory = $factory;
        $this->wpDelegate = $wpDelegate;
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        foreach ($this->actions as $action) {
            if ($action instanceof HookType) {
                $this->wpDelegate->addAction(
                    $action->getName(),
                    $action->getCallback(),
                    $action->getPriority(),
                    $action->getNumberOfParameters()
                );
            } //endif
        } //endforeach

        foreach ($this->filters as $filter) {
            if ($filter instanceof HookType) {
                $this->wpDelegate->addFilter(
                    $filter->getName(),
                    $filter->getCallback(),
                    $filter->getPriority(),
                    $filter->getNumberOfParameters()
                );
            } //endif
        } //endforeach

        return $this;
    }
}
