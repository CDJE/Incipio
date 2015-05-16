<?php

namespace ApiBundle\Tests;

/**
 * Interface FluentTestCaseInterface: test case to insure the tested class properly implements the fluent interface.
 *
 * @link   http://en.wikipedia.org/wiki/Fluent_interface
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
interface FluentTestCaseInterface
{
    /**
     * Test if the class properly implements the fluent interface.
     *
     * @param array $data Set of data to hydrate the entity with.
     *
     * @return
     */
    public function testFluentImplementation(array $data = []);
}
