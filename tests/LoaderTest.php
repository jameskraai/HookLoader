<?php

namespace JKraai\Hook\Tests;

use Closure;
use JKraai\Hook\Hook;
use Mockery;
use JKraai\Hook\Loader;
use JKraai\Hook\Factory;
use JKraai\Hook\WordPressDelegate;

/**
 * Tests the Loader class.
 */
class LoaderTest extends TestCase
{
    /**
     * Test that the Hooks we add to the Loader will be registered
     * with the WordPress Delegate.
     *
     * @covers \JKraai\Hook\Loader::register
     */
    public function testHooksAreRegistered()
    {
        // Make a Loader and add some Actions and Filters to it.
        $loader = $this->makeLoader();
        $callback = $this->makeCallback();

        $loader->addAction("My Action", $callback, 1, 1);
        $loader->addFilter("My Filter", $callback, 1, 1);

        // Assert that the WordPress Delegate receives instructions
        // to add Filters and Actions.
        $loader->wpDelegate->shouldReceive('addAction');
        $loader->wpDelegate->shouldReceive('addFilter');

        $result = $loader->register();

        $this->assertInstanceOf(Loader::class, $result);
    }

    /**
     * Test that we are able to add actions to the Loader.
     *
     * @covers \JKraai\Hook\Loader::__construct
     * @covers \JKraai\Hook\Loader::addAction
     */
    public function testAbleToAddActions()
    {
        $loader = $this->makeLoader();
        $callback = $this->makeCallback();

        $result = $loader->addAction("Hook", $callback, 1, 1);

        $this->assertInstanceOf(Loader::class, $result);
    }

    /**
     * Test that we are able to add a filter to the Loader.
     *
     * @covers \JKraai\Hook\Loader::addFilter()
     */
    public function testAbleToAddFilters()
    {
        $loader = $this->makeLoader();
        $callback = $this->makeCallback();

        $result = $loader->addFilter("Filter", $callback, 1, 1);

        $this->assertInstanceOf(Loader::class, $result);
    }

    /**
     * Test that we are able to respond to POST requests.
     *
     * @covers \JKraai\Hook\Loader::post
     */
    public function testAbleToRespondToPost()
    {
        $loader = $this->makeLoader();
        $callback = $this->makeCallback();

        $result = $loader->post("post_update", $callback);

        $this->assertInstanceOf(Loader::class, $result);
    }

    /**
     * Test that we are able to respond to AJAX requests.
     *
     * @covers \JKraai\Hook\Loader::ajax
     */
    public function testAbleToRespondToAJAX()
    {
        $loader = $this->makeLoader();
        $callback = $this->makeCallback();

        $result = $loader->ajax("post_update", $callback);

        $this->assertInstanceOf(Loader::class, $result);
    }

    /**
     * Test that we are able to respond to public AJAX requests.
     *
     * @covers \JKraai\Hook\Loader::ajax
     */
    public function testRespondingToPublicAJAX()
    {
        $loader = $this->makeLoader();
        $callback = $this->makeCallback();

        $result = $loader->ajax("post_update", $callback, true);

        $this->assertInstanceOf(Loader::class, $result);
    }

    /**
     * Returns a new Loader instance for testing.
     *
     * @return Loader
     */
    protected function makeLoader()
    {
        $factory = $this->makeFactory();
        $wpDelegate = Mockery::mock(WordPressDelegate::class);

        return new Loader($factory, $wpDelegate);
    }

    /**
     * Returns a Factory with a mock Hook that will be returned.
     *
     * @return Factory
     */
    protected function makeFactory()
    {
        $hook = $this->makeHook();

        return new Factory($hook);
    }

    /**
     * Returns a new Mock Hook.
     *
     * @return Hook
     */
    protected function makeHook()
    {
        return new Hook();
    }

    /**
     * Returns a new Callback for testing.
     *
     * @return Closure
     */
    protected function makeCallback()
    {
        return function () {
            // callback
        };
    }
}
