<?php

namespace ApiBundle\Tests\Entity;

use ApiBundle\Tests\FluentTestCaseInterface;
use Symfony\Component\PropertyAccess\StringUtil;

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
     * Note: this method looks for hasser, removers and setters. It works on most cases but it still possible to have
     * some edge cases not handled. In this case do overwrite this method.
     *
     * @dataProvider fluentDataProvider
     */
    public function testFluentImplementation(array $data = [])
    {
        $reflClass = new \ReflectionClass($this);
        $entity = $reflClass->newInstanceArgs();

        foreach ($data as $property => $value) {
            $results = [];
            $camelized = $this->camelize($property);
            $singulars = (array) StringUtil::singularify($camelized);
            $methods = $this->findAdderAndRemover($reflClass, $singulars);

            if (null !== $methods) {
                $results[$methods[0]] = $entity->methods[0]($value);
                $results[$methods[1]] = $entity->methods[1]($value);
            } else {
                $setter = 'set'.$camelized;
                if ($this->isMethodAccessible($reflClass, $setter, 1)) {
                    $results[$setter] = $entity->$setter($value);
                }
            }

            foreach ($results as $method => $returnedValue) {
                $this->assertEquals(
                    $reflClass->getName(),
                    get_class($returnedValue),
                    sprintf('Expected %s to return a %s object.', $method, $reflClass->getName())
                );
            }
        }
    }

    /**
     * Test the entity property accessors (getters, setters, hassers, issers).
     *
     * @param array $data
     *
     * @return
     */
    abstract public function testPropertyAccessors(array $data = []);

    /**
     * Provides an optimal set of data for generating a complete entity.
     */
    abstract public function fluentDataProvider();

    /**
     * Camelizes a given string.
     *
     * @see \Symfony\Component\PropertyAccessor::camelize()
     *
     * @param string $string Some string
     *
     * @return string The camelized version of the string
     */
    private function camelize($string)
    {
        return strtr(ucwords(strtr($string, array('_' => ' '))), array(' ' => ''));
    }

    /**
     * Searches for add and remove methods.
     *
     * @see \Symfony\Component\PropertyAccessor::findAdderAndRemover()
     *
     * @param \ReflectionClass $reflClass The reflection class for the given object
     * @param array            $singulars The singular form of the property name or null
     *
     * @return array|null An array containing the adder and remover when found, null otherwise
     */
    private function findAdderAndRemover(\ReflectionClass $reflClass, array $singulars)
    {
        foreach ($singulars as $singular) {
            $addMethod = 'add'.$singular;
            $removeMethod = 'remove'.$singular;

            $addMethodFound = $this->isMethodAccessible($reflClass, $addMethod, 1);
            $removeMethodFound = $this->isMethodAccessible($reflClass, $removeMethod, 1);

            if ($addMethodFound && $removeMethodFound) {
                return array($addMethod, $removeMethod);
            }
        }
    }

    /**
     * Returns whether a method is public and has the number of required parameters.
     *
     * @see \Symfony\Component\PropertyAccessor::isMethodAccessible()
     *
     * @param \ReflectionClass $class      The class of the method
     * @param string           $methodName The method name
     * @param int              $parameters The number of parameters
     *
     * @return bool Whether the method is public and has $parameters
     *              required parameters
     */
    private function isMethodAccessible(\ReflectionClass $class, $methodName, $parameters)
    {
        if ($class->hasMethod($methodName)) {
            $method = $class->getMethod($methodName);

            if ($method->isPublic()
                && $method->getNumberOfRequiredParameters() <= $parameters
                && $method->getNumberOfParameters() >= $parameters) {
                return true;
            }
        }

        return false;
    }
}
