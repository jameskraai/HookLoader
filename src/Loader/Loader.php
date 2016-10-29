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
     * Factory that makes new Hooks. This is used when we add a new Action or
     * Filter Hook to this Loader.
     *
     * @var Factory
     */
    public $hookFactory;

    /**
     * We are able to use this to delegate the task of making global function
     * calls to WordPress.
     *
     * @var WPDelegate
     */
    public $wpDelegate;
    
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

    /**
     * {@inheritdoc}
     */
    public function addAction($name, $callback, $priority, $numberOfArguments)
    {
        $action = $this->hookFactory->make();
        $action->setName($name);
        $action->setCallback($callback);
        $action->setPriority($priority);
        $action->setNumberOfParameters($numberOfArguments);

        $this->actions[] = $action;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addFilter($name, $callback, $priority, $numberOfArguments)
    {
        $filter = $this->hookFactory->make();
        $filter->setName($name);
        $filter->setCallback($callback);
        $filter->setPriority($priority);
        $filter->setNumberOfParameters($numberOfArguments);

        $this->filters[] = $filter;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function post($query, $callback)
    {
        $this->addAction("admin_post_{$query}", $callback, 10, 1);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function ajax($query, $callback, $public = false)
    {
        $hookName = "wp_ajax_{$query}";

        if ($public) {
            $hookName = "wp_ajax_nopriv_{$query}";
        }

        $this->addAction($hookName, $callback, 10, 1);

        return $this;
    }
}
