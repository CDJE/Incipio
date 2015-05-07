<?php

namespace FrontBundle\Twig;

/**
 * Class FrontExtension: class used to create custom Twig functionalities and filters.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class FrontExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('uriId', [$this, 'uriIdFilter']),
        ];
    }

    /**
     * Extract the ID which is given in URI form (typically in the @id tag).
     *
     * @example
     *
     *  jsonLdIfFilter('/api/users/101')            // "101"
     *  jsonLdIfFilter('/api/mandates/AaKxazRT')    // "AaKxazRT"
     *
     * @param $uri
     *
     * @return string
     */
    public function uriIdFilter($uri)
    {
        return substr(strrchr($uri, '/'), 1);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'front_extension';
    }
}
