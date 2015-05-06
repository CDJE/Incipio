<?php

namespace FrontBundle\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class FrontUserBundle: child bundle of the FOSUserBundle.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class FrontUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
