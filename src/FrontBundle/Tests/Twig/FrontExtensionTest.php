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
        $this->assertEquals($expected,
            $actual,
            sprintf('Wrong ID extracted, got `%s` instead of `%s`.', $actual, $expected)
        );
    }

    /**
     * @return array List of "uri ID" with the matching ID.
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
}
