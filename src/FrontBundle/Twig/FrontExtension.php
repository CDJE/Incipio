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
            new \Twig_SimpleFilter('role', [$this, 'roleFilter']),
        ];
    }

    /**
     * Extract the ID which is given in URI form (typically in the @id tag).
     *
     * This is done by extracting the last part of the URI.
     *
     * @example
     *
     *  uriIdFilter('/api/users/101')            // "101"
     *  uriIdFilter('/api/mandates/AaKxazRT')    // "AaKxazRT"
     *  uriIdFilter('/api/')                     // ""
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
     * Reformat role in a clean way.
     *
     * @example
     *  roleFilter('ROLE_USER')         // "user"
     *  roleFilter('ROLE_ADMIN')        // "admin"
     *  roleFilter('ROLE_SUPER_ADMIN')  // "root"
     *
     * @param string $role Valid Symfony role.
     *
     * @return string
     */
    public function roleFilter($role)
    {
        if ('ROLE_SUPER_ADMIN' === $role) {
            return 'root';
        }

        return strtolower(substr($role, 5));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'front_extension';
    }
}
