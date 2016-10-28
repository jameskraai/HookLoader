<?php

namespace JKraai\Hook\Tests;

use Mockery;
use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Base test case for the rest of our library tests.
 */
class TestCase extends PHPUnit
{
    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
