<?php

namespace ApiBundle\Tests\Entity;

use ApiBundle\Tests\FluentTestCaseInterface;

/**
 * Class EntityTestCase: test case for entities.
 *
 * @link   http://en.wikipedia.org/wiki/Fluent_interface
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
abstract class EntityTestCaseAbstract extends \PHPUnit_Framework_TestCase implements FluentTestCaseInterface
{
    /**
     * {@inheritdoc}
     *
     * @dataProvider fluentDataProvider
     */
    final public function testFluentImplementation(array $data = [])
    {
        $class    = $this->getClass();
        $entity   = new $class();

        foreach ($data as $propertyName => $propertyValue) {
            $camilizedPropertyName = $this->camelize($propertyName);
            //TODO: get method in other way instead (via ReflectionClass)
            //TODO: handle add/remove methods
            $setter = "set$camilizedPropertyName";
            $entity = $entity->$setter($propertyValue);

            $this->assertEquals($class, get_class($entity), 'Expected setter to return class instance.');
        }
    }

    /**
     * Test the entity property accessors (getters, setters, hassers, issers).
     */
    abstract public function testPropertyAccessors();

    /**
     * Provides an optimal set of data for generating a complete entity.
     */
    abstract public function fluentDataProvider();

    /**
     * @return string Tested entity fully qualified name.
     */
    abstract public function getClass();

    /**
     * Camelizes a given string.
     *
     * @see \Symfony\Component\PropertyAccess::camelize
     *
     * @param string $string Some string
     *
     * @return string The camelized version of the string
     */
    private function camelize($string)
    {
        return strtr(ucwords(strtr($string, array('_' => ' '))), array(' ' => ''));
    }
}
