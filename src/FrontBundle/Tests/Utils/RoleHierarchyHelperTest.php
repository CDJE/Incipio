<?php

namespace FrontBundle\Tests\Utils;

use FrontBundle\Utils\RoleHierarchyHelper;

/**
 * Class RoleHierarchyHelperTest.
 *
 * @see    FrontBundle\Utils\RoleHierarchyHelper
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class RoleHierarchyHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RoleHierarchyHelper
     */
    private $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = new RoleHierarchyHelper();
    }

    /**
     * Test RoleHierarchyHelper::getTopLevelRole().
     *
     * @param array       $roles    List of roles.
     * @param string|null $expected Expected value returned by the method.
     *
     * @dataProvider rolesProvider
     */
    public function testGetTopLevelRole(array $roles, $expected)
    {
        $actual = $this->helper->getTopLevelRole($roles);
        $this->assertEquals($expected, $actual, 'Top level role returned is not the expected one.');
    }

    /**
     * @return array List of roles.
     */
    public function rolesProvider()
    {
        return [
            [['ROLE_ADMIN', 'ROLE_USER'], 'ROLE_ADMIN'],
            [['ROLE_SUPER_ADMIN', 'ROLE_USER'], 'ROLE_SUPER_ADMIN'],
            [['ROLE_USER'], 'ROLE_USER'],
            [['ROLE_ALLOWED_TO_SWITCH', 'ROLE_USER'], 'ROLE_USER'],
            [['ROLE_ALLOWED_TO_SWITCH'], null],
            [['ROLE_ADMIN', 'ROLE_USER', 'ROLE_SUPER_ADMIN'], 'ROLE_SUPER_ADMIN'],
        ];
    }
}
