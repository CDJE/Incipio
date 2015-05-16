<?php

namespace FrontBundle\Tests\DependencyInjection;

use FrontBundle\DependencyInjection\FrontExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

/**
 * Class FrontExtensionTest.
 *
 * @see FrontBundle\DependencyInjection\FrontExtension
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class FrontExtensionTest extends AbstractExtensionTestCase
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
            new FrontExtension(),
        );
    }
}
