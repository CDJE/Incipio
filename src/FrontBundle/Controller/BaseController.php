<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class BaseController.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class BaseController extends Controller
{
    /**
     * {@inheritdoc}
     *
     * Note: if `id` parameter is passed and its value is an URI, the ID is automatically extracted from it. This is
     * done my assuming that the ID is the last member of the URI and that and URI begins by `/`.
     */
    public function generateUrl($route, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return parent::generateUrl($route, $this->extractId($parameters), $referenceType);
    }

    /**
     * If `id` parameter is passed and its value is an URI, the ID is automatically extracted from it. This is
     * done my assuming that the ID is the last member of the URI and that and URI begins by `/`.
     *
     * If the `id` parameter is not an URI, its value is left unchanged.
     *
     * @param array $parameters
     *
     * @return array $parameters with the new value for the `id` key.
     */
    public function extractId(array $parameters)
    {
        if (array_key_exists('id', $parameters) && 0 === strpos($parameters['id'], '/')) {
            $parameters['id'] = substr(strrchr($parameters['id'], '/'), 1);
        }

        return $parameters;
    }
}
