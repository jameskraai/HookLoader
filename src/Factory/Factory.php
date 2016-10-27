<?php

namespace JKraai\Hook;

/**
 * Factory for making new Hooks.
 */
class Factory
{
    /**
     * An instance of the Hook Type that we can clone. We are able to do this
     * since all Hooks are the same in their default state.
     *
     * @var Cloneable
     */
    protected $hook;

    /**
     * Factory constructor.
     *
     * @param Cloneable $hook Fresh Hook that we can clone.
     */
    public function __construct(Cloneable $hook)
    {
        $this->hook = $hook;
    }

    /**
     * Make a new Hook by cloning the one we have. This allows us to avoid
     * relying on a factory or service container.
     *
     * @return HookType
     */
    public function make()
    {
        /** @var HookType $hook */
        $hook = clone $this->hook;

        return $hook;
    }
}
