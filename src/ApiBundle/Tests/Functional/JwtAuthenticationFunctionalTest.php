<?php

namespace ApiBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class JwtAuthenticationTest.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class JwtAuthenticationFunctionalTest extends WebTestCase
{
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $username User name or email.
     * @param string $password User password.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     *
     * @throws \Exception Thrown if could not get API token.
     */
    private function createAuthenticatedClient($username, $password)
    {
        $client = static::createClient();
        $client->setServerParameter('CONTENT_TYPE', 'multipart/form-data');
        $client->request(
            'POST',
            '/api/login_check',
            [
                'username' => $username,
                'password' => $password,
            ]
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        if (false === array_key_exists('token', $data)) {
            sprintf(
                'Expected to find API token in the response. Got %s code response.',
                $client->getResponse()->getStatusCode()
            );
        }

        $token = $data['token'];
        $client->getContainer()->get('session')->set('_security_main', serialize($token));

        $client = self::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));

        return $client;
    }

    /**
     * Ensure that the user can properly access to all pages once logged.
     *
     * @dataProvider authProvider
     *
     * @param array  $user User credentials.
     * @param string $page Page URI.
     */
    public function testGetPages(array $user, $page)
    {
        $client = $this->createAuthenticatedClient($user['username'], $user['password']);
        $client->request('GET', $page);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode(), 'Expected to get page.');
    }

    /**
     * Ensure that the user cannot access to pages when not logged.
     *
     * @dataProvider pageProvider
     */
    public function testGetPagesWhenUnauthentified($page)
    {
        $client = static::createClient();
        $client->request('GET', $page);
        $this->assertEquals(Response::HTTP_UNAUTHORIZED,
            $client->getResponse()->getStatusCode(),
            'Expected to not being able to get page.'
        );
    }

    /**
     * @return array List of pages to access with users logins.
     */
    public function authProvider()
    {
        $users = $this->userProvider();
        $pages = $this->pageProvider();
        $return = [];

        foreach ($users as $argUser) {
            foreach ($pages as $argPage) {
                $return[] = [
                    $argUser[0],
                    $argPage[0],
                ];
            }
        }

        return $return;
    }

    /**
     * @return array List of users.
     */
    public function userProvider()
    {
        return [
            [
                [
                    'username' => 'admin',
                    'password' => 'admin',
                ],
            ],
            [
                [
                    'username' => 'admin@incipio.fr',
                    'password' => 'admin',
                ],
            ],
            [
                [
                    'username' => 'ca',
                    'password' => 'ca',
                ],
            ],
            [
                [
                    'username' => 'ca@incipio.fr',
                    'password' => 'ca',
                ],
            ],
            [
                [
                    'username' => 'guest',
                    'password' => 'guest',
                ],
            ],
            [
                [
                    'username' => 'guest@incipio.fr',
                    'password' => 'guest',
                ],
            ],
        ];
    }

    /**
     * @return array List of API pages.
     */
    public function pageProvider()
    {
        return [
            ['/api/'],
            ['/api/contexts/Entrypoint'],
            ['/api/jobs'],
            ['/api/mandates'],
            ['/api/users'],
            ['/api/vocab'],
//            ['/api-doc/'], -> Nelmio doc broken at the moment TODO: change that!
        ];
    }
}
