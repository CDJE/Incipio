<?php

namespace ApiBundle\Bundle\UserBundle\Tests\Utils;

use ApiBundle\Utils\UserRoles;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class RolesHelperTest.
 *
 * @see    ApiBundle\Bundle\UserBundle\Utils\RolesHelper
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class RolesHelperTest extends KernelTestCase
{
    /**
     * @var UserRoles
     */
    private $service;

    /**
     * @var array List of roles used in the system.
     */
    private $roles = [
        'ROLE_ADMIN',
        'ROLE_ALLOWED_TO_SWITCH',
        'ROLE_CA',
        'ROLE_SUPER_ADMIN',
        'ROLE_USER',
    ];

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->service = self::$kernel->getContainer()->get('api.user.roles');
    }

    /**
     * Test the service's methods.
     */
    public function testService()
    {
        $serviceRoles = $this->service->getRoles();

        foreach ($this->roles as $role) {
            $this->assertTrue(in_array($role, $serviceRoles), "Role $role was expected to be found by the service.");
        }
    }
}
