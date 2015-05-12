<?php

namespace FrontBundle\Tests\Twig;

use FrontBundle\Twig\FrontExtension;

/**
 * Class FrontExtensionTest.
 *
 * @see FrontBundle\Twig\FrontExtension
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class FrontExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FrontExtension
     */
    protected $extension;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->extension = new FrontExtension();
    }

    /**
     * Test if the filter is properly returned.
     */
    public function testGetFilters()
    {
        $filters = $this->extension->getFilters();

        $this->assertGreaterThanOrEqual(1, $filters);
    }

    /**
     * Test FrontExtension::uriIdFilter().
     *
     * @param string $uri      Input value.
     * @param string $expected Expected output value.
     *
     * @dataProvider uriIdProvider
     */
    public function testUriIdFilter($uri, $expected)
    {
        $actual = $this->extension->uriIdFilter($uri);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test FrontExtension::roleFilter().
     *
     * @param string $role
     * @param string $expected
     *
     * @dataProvider roleProvider
     */
    public function testRoleFilter($role, $expected)
    {
        $actual = $this->extension->roleFilter($role);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array List of "uri ID" with their true ID.
     */
    public function uriIdProvider()
    {
        return [
            ['/api/users/101', '101'],
            ['/mandates/102', '102'],
            ['/32', '32'],
            ['/api/users/admin', 'admin'],
            ['/api/users/this-is-a-slug', 'this-is-a-slug'],
            ['/api/users/ii6VpD72', 'ii6VpD72'],
            ['/api/users/', ''],
        ];
    }

    /**
     * @return array List of Symfony role and their expected result.
     */
    public function roleProvider()
    {
        return [
            ['ROLE_USER', 'user'],
            ['ROLE_ADMIN', 'admin'],
            ['ROLE_SUPER_ADMIN', 'root'],
            ['ROLE_RANDOM', 'random'],
            ['ROLE_SUPER_RANDOM', 'super_random'],
        ];
    }
}
