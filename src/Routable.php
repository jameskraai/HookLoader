<?php

namespace JKraai\Hook;

/**
 * WordPress does not natively support "routes" per se. However we are able to
 * emulate much of the http verbs we expect by using default Action hooks
 * that WordPress can then handle as it sees fit. This interface
 * defines those http verbs that an implementation can then
 * use to route them to WordPress.
 */
interface Routable
{
    /**
     * Respond to an ajax request with the provided callback. The public flag
     * indicates to WordPress if we want this callback to only be run for
     * authenticated Users or to anyone - hence the name.
     *
     * @param  string           $query    Name of the query we are listening for.
     * @param  callable|string  $callback Invoked when the query is found.
     * @param  boolean          $public   If this end point is for authenticated Users only.
     *
     * @return $this
     */
    public function ajax($query, $callback, $public = false);

    /**
     * Respond to an incoming POST request from an authenticated User.
     *
     * @param  string          $query    Name of the query we are listening for.
     * @param  callable|string $callback Invoked when the query is found.
     *
     * @return $this
     */
    public function post($query, $callback);

    /**
     * Respond to an incoming GET request.
     *
     * @param  string $query Query key we are listening for.
     * @param  string $value Value of the query to listen for.
     * @param  callable|string Invoked when the query is found.
     *
     * @return $this
     */
    public function get($query, $value, $callback);
}
