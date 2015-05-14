<?php

namespace FrontBundle\Tests\Client;

use FrontBundle\Client\ApiClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class ApiClientTest.
 *
 * @see    FrontBundle\Client\ApiClient
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class ApiClientTest extends KernelTestCase
{
    /**
     * @var ApiClient
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->service = self::$kernel->getContainer()->get('api.client');
    }

/**
 * @dataProvider routeProvider
 *
 * @param string $route Input route name.
 * @param string $uri   Route's URI.
 */
    //TODO: refactor get method and add tests for headers too
    public function testUriGenerator($route, $uri)
    {
        $requests = $this->generatedRequests([
            'route' => $route,
            'uri' => $uri,
        ]);

        foreach ($requests as $request) {
            $this->assertEquals($uri, $request->getPath(), 'Expected Request path to match URI.');
        }
    }

    /**
     * @dataProvider routeWithTokenProvider
     *
     * @param string $route Input route name.
     * @param string $uri   Route's URI.
     * @param string $token API Token.
     */
    public function testUriGeneratorWithToken($route, $uri, $token)
    {
        $requests = $this->generatedRequests([
            'route' => $route,
            'uri' => $uri,
            'token' => $token,
        ]);

        foreach ($requests as $request) {
            $this->assertEquals($uri, $request->getPath(), 'Expected Request path to match URI.');
            /* @var \Guzzle\Http\Message\Header */
            $header = $request->getHeaders()->get('authorization');
            $this->assertTrue(
                $header->hasValue(sprintf('Bearer %s', $token)),
                'Expected Authorization header to have API key.'
            );
        }
    }

    /**
     * @dataProvider routeWithQueryProvider
     *
     * @param string $route Input route name.
     * @param string $uri   Route's URI.
     * @param string $query Query parameters.
     */
    public function testUriGeneratorWithQuery($route, $uri, $query)
    {
        $requests = $this->generatedRequests([
            'route' => $route,
            'uri' => $uri,
            'query' => $query,
        ]);

        foreach ($requests as $request) {
            $this->assertEquals($uri, $request->getPath(), 'Expected Request path to match URI.');
            $queries = $request->getQuery()->getAll();
            $this->assertEquals($queries, $query, 'Expected request to have query.');
        }
    }

    /**
     * @dataProvider routeWithTokenAndQueryProvider
     *
     * @param string $route Input route name.
     * @param string $uri   Route's URI.
     * @param string $token API Token.
     * @param string $query Query parameters.
     */
    public function testUriGeneratorWithTokenAndQuery($route, $uri, $token, $query)
    {
        $requests = $this->generatedRequests([
            'route' => $route,
            'uri' => $uri,
            'token' => $token,
            'query' => $query,
        ]);

        foreach ($requests as $request) {
            $this->assertEquals($uri, $request->getPath(), 'Expected Request path to match URI.');
            $queries = $request->getQuery()->getAll();
            $this->assertEquals($queries, $query, 'Expected request to have query.');
            /* @var \Guzzle\Http\Message\Header */
            $header = $request->getHeaders()->get('authorization');
            $this->assertTrue(
                $header->hasValue(sprintf('Bearer %s', $token)),
                'Expected Authorization header to have API key.'
            );
        }
    }

    /**
     * Generate the list of requests to test with the parameters provided.
     *
     * @param array $inputs Input parameters.
     *
     * @return \Guzzle\Http\Message\RequestInterface[] List of requests.
     */
    private function generatedRequests(array $inputs)
    {
        $requests = [];

        if (array_key_exists('token', $inputs)) {
            if (array_key_exists('query', $inputs)) {
                $requests[] = $this->service->get($inputs['route'], $inputs['token'], ['query' => $inputs['query']]);
                $requests[] = $this->service->get($inputs['uri'], $inputs['token'], ['query' => $inputs['query']]);
            } else {
                $requests[] = $this->service->get($inputs['route'], $inputs['token']);
                $requests[] = $this->service->get($inputs['uri'], $inputs['token']);
            }
        } else {
            if (array_key_exists('query', $inputs)) {
                $requests[] = $this->service->get($inputs['route'], null, ['query' => $inputs['query']]);
                $requests[] = $this->service->get($inputs['uri'], null, ['query' => $inputs['query']]);
            } else {
                $requests[] = $this->service->get($inputs['route'], null);
                $requests[] = $this->service->get($inputs['uri'], null);
            }
        }

        return $requests;
    }

    /**
     * @return array List of routes and matching URI.
     */
    public function routeProvider()
    {
        return [
            [
                0 => 'dashboard',
                1 => '/',
            ],
            [
                0 => 'nelmio_api_doc_index',
                1 => '/api-doc/',
            ],
            [
                0 => 'fos_user_security_login',
                1 => '/login',
            ],
            [
                0 => 'users_cget',
                1 => '/api/users',
            ],
        ];
    }

    /**
     * @return array List of routes, their matching URI and API tokens.
     */
    public function routeWithTokenProvider()
    {
        $sourceValues = $this->routeProvider();
        $values = [];

        foreach ($sourceValues as $dataSet) {
            $dataSet[2] = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MzEyODQ0NjYsInVzZXJuYW1lIjoiYWRtaW4iLCJpYXQiOiIxNDMxMTk4MDY2In0.ChSbITRMHQWS_tNP5slOU70YO2fxjtJ7QeMsDKXe9A7uT7dijPnxOQllZLZ8ntvThlPchWiHZbtLJ700bEibMD2zlOLRQCTMjCvUwAGX9TDBb3geaPb9vKBDntk0PwKzfN7v8WQmhH2BI0UPHr-XCFRW3x8Xdnbjqd3FbbRmHlWY2TJUcrGmk5qADj7uCXToejnrt40OySIKT61RM0iW16dvjplMqWkuc4va-alBnNKRBbZZIdjZMGLTZOXrCqYoHKTUxuOElLwbWdfBjoPqgvNPGRAa6vodpXfXr8V2VXWQO5l-7p1JUcN5__AfTIjSzpb1vBasav4BA9xVx1ZAbuOWTkuYeo8Bq0i_Vm_hYngfkWZg_7JODdnd7ExnTBJxZuqicDpJX-imtVdb0-6gAc8VgNEfw5Ws0y8iQRONXEZ_xfYvMPudJihFC48PpbaVTp6bBeo4SzqP-MJJn9aHWS96L6NvSXeMaZWlx7F6riUCgBFMcR_r7_Ljluc53RQNULP3KgXpiVnQKxfz8Hggxr47QSrULb-D6tEA8fs7Bx9-cbeYo5hv0bB-EIrJc_NUfqN5T_dd_sVTS_bnZzG_a8zvc_kx34xXT4UzWFp7Sg86blwNyTJ7ZXj-lSabQpLjQQ3AWRvsW5L6nMOKOXAfDkwGTAeskdS4h6wjSqTkU0Q';
            ksort($dataSet);
            $values[] = $dataSet;
        }

        return $values;
    }

    /**
     * @return array List of routes, their matching URI and query parameters.
     */
    public function routeWithQueryProvider()
    {
        $sourceValues = $this->routeProvider();
        $values = [];

        foreach ($sourceValues as $dataSet) {
            $dataSet[3] = ['property' => 'value'];
            ksort($dataSet);
            $values[] = $dataSet;
        }

        return $values;
    }

    /**
     * @return array List of routes, their matching URI, API tokens and query parameters.
     */
    public function routeWithTokenAndQueryProvider()
    {
        $sourceValues = $this->routeWithQueryProvider();
        $values = [];

        foreach ($sourceValues as $dataSet) {
            $dataSet[2] = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MzEyODQ0NjYsInVzZXJuYW1lIjoiYWRtaW4iLCJpYXQiOiIxNDMxMTk4MDY2In0.ChSbITRMHQWS_tNP5slOU70YO2fxjtJ7QeMsDKXe9A7uT7dijPnxOQllZLZ8ntvThlPchWiHZbtLJ700bEibMD2zlOLRQCTMjCvUwAGX9TDBb3geaPb9vKBDntk0PwKzfN7v8WQmhH2BI0UPHr-XCFRW3x8Xdnbjqd3FbbRmHlWY2TJUcrGmk5qADj7uCXToejnrt40OySIKT61RM0iW16dvjplMqWkuc4va-alBnNKRBbZZIdjZMGLTZOXrCqYoHKTUxuOElLwbWdfBjoPqgvNPGRAa6vodpXfXr8V2VXWQO5l-7p1JUcN5__AfTIjSzpb1vBasav4BA9xVx1ZAbuOWTkuYeo8Bq0i_Vm_hYngfkWZg_7JODdnd7ExnTBJxZuqicDpJX-imtVdb0-6gAc8VgNEfw5Ws0y8iQRONXEZ_xfYvMPudJihFC48PpbaVTp6bBeo4SzqP-MJJn9aHWS96L6NvSXeMaZWlx7F6riUCgBFMcR_r7_Ljluc53RQNULP3KgXpiVnQKxfz8Hggxr47QSrULb-D6tEA8fs7Bx9-cbeYo5hv0bB-EIrJc_NUfqN5T_dd_sVTS_bnZzG_a8zvc_kx34xXT4UzWFp7Sg86blwNyTJ7ZXj-lSabQpLjQQ3AWRvsW5L6nMOKOXAfDkwGTAeskdS4h6wjSqTkU0Q';
            ksort($dataSet);
            $values[] = $dataSet;
        }

        return $values;
    }
}
