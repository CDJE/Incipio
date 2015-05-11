<?php

namespace ApiBundle\Tests\DependencyInjection;

use ApiBundle\DependencyInjection\ApiExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

/**
 * Class ApiExtensionTest.
 *
 * @see ApiBundle\DependencyInjection\ApiExtension
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class ApiExtensionTest extends AbstractExtensionTestCase
{
    /**
     * Ensure that the Bundle extension load properly.
     */
    public function testLoading()
    {
        $this->load();
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions()
    {
        return array(
            new ApiExtension()
        );
    }
}
