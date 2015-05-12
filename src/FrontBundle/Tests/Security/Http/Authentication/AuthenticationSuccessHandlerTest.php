<?php

namespace FrontBundle\Tests\Security\Http\Authentication;

use FrontBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Class AuthenticationSuccessHandlerTest.
 *
 * @see FrontBundle\Security\Http\Authentication\AuthenticationSuccessHandler
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class AuthenticationSuccessHandlerTest extends \PHPUnit_Framework_TestCase
{
    // TODO
    // @see Lexik\Bundle\JWTAuthenticationBundle\Tests\Security\Http\Authentication\AuthenticationSuccessHandlerTest
    // @see Symfony\Component\Security\Http\Tests\Authentication\DefaultAuthenticationSuccessHandlerTest
}
