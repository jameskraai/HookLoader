<?php

namespace JKraai\Hook;

/**
 * In an effort to keep the rest of our source code clean from global WordPress
 * API function calls any such calls can be contained within this class. This
 * class has the delegated responsibility of making these calls to WordPress.
 */
class WordPressDelegate
{
    /**
     * See the WordPress docs for details on this function.
     *
     * @param string   $name
     * @param callable $callback
     * @param int      $priority
     * @param int      $numberOfParameters
     */
    public function addAction($name, $callback, $priority, $numberOfParameters)
    {
        return add_action($name, $callback, $priority, $numberOfParameters);
    }

    /**
     * See the WordPress docs for details on this function.
     *
     * @param string   $name
     * @param callable $callback
     * @param int      $priority
     * @param int      $numberOfParameters
     */
    public function addFilter($name, $callback, $priority, $numberOfParameters)
    {
        return add_filter($name, $callback, $priority, $numberOfParameters);
    }
}
