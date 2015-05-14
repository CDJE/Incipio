<?php

namespace FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * Class MenuBuilder: creates menu for the front layer.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var AuthorizationChecker
     */
    private $authorizationChecker;

    /**
     * @param FactoryInterface     $factory
     * @param AuthorizationChecker $authorizationChecker
     * @param TokenStorage         $tokenStorage
     */
    public function __construct(
        FactoryInterface $factory,
        AuthorizationChecker $authorizationChecker,
        TokenStorage $tokenStorage
    ) {
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Menu used for the header.
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createHeaderMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        // Dashboard
        $menu
            ->addChild(
                'dashboard',
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                ]
            )
            ->setAttribute('icon', 'fa fa-tachometer')
        ;

        // Association Management
        $menu->addChild($this->createAssociationManagementMenu());

        return $menu;
    }

    /**
     * Creates the menu for the association management.
     *
     * @return \Knp\Menu\ItemInterface
     */
    private function createAssociationManagementMenu()
    {
        $menu = $this->factory->createItem('association-management');
        $menu
            ->setAttribute('dropdown', true)
            ->setLabel('Gestion associative')
        ;

        $menu->addChild(
            'users',
            [
                'label' => 'Liste des membres',
                'route' => 'users',
            ]
        );

        return $menu;
    }

    /**
     * Creates the menu for the user (name, profile, logout).
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createUserMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');

        // User Profile
        // Check if user is authenticated
        if (!$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
            || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
        ) {
            $menu->addChild(
                'users',
                [
                    'label' => 'Login',
                    'route' => 'fos_user_security_login',
                ]
            );

            return $menu;
        }

        // User is authenticated
        $user = $this->tokenStorage->getToken()->getUser();

        $menu->addChild(
            'profile',
            [
                'label' => $user->getUsername(),
                'route' => 'users',
            ]
        );

        $menu->addChild(
            'logout',
            [
                'label' => '',
                'route' => 'fos_user_security_logout',
            ]
        )->setAttribute('icon', 'fa fa-sign-out');

        return $menu;
    }
}
