<?php

namespace ApiBundle\Tests\Entity;

use ApiBundle\Entity\Job;
use ApiBundle\Entity\User;

/**
 * Class UserTest.
 *
 * @see    ApiBundle\Entity\User
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class UserTest extends EntityTestCaseAbstract
{
    /**
     * {@inheritdoc}
     *
     * @dataProvider fluentDataProvider
     */
    public function testPropertyAccessors(array $data = [])
    {
        $user = new User();

        $user
            ->setUsername($data['username'])
            ->setFullname($data['fullname'])
            ->setEmail($data['email'])
            ->setRoles($data['roles'])
            ->setPlainPassword($data['plainPassword'])
            ->setEnabled($data['enabled'])
            ->addJob($data['job'])
        ;

        // Test classic setters
        $this->assertEquals($data['username'], $user->getUsername());
        $this->assertEquals($data['fullname'], $user->getFullname());
        $this->assertEquals($data['email'], $user->getEmail());
        foreach ($data['roles'] as $role) {
            $this->assertTrue(in_array($role, $user->getRoles()));
        }
        $this->assertEquals($data['plainPassword'], $user->getPlainPassword());
        $this->assertEquals($data['enabled'], $user->isEnabled());
        $this->assertTrue($user->getJobs()->contains($data['job']));

        // Test if relations has been properly set
        $this->assertEquals($user, $data['job']->getUser());

        // Test if properties and relations can be reset
        $user
            ->setUsername(null)
            ->setFullname(null)
            ->setEmail(null)
            ->setPlainPassword(null)
            ->setEnabled(null)
            ->removeJob($data['job'])
        ;
        try {
            $user->setRoles(null);
        } catch (\Exception $e) {
            // Expect error thrown
        }
        $user->setRoles([]);

        $this->assertEquals(null, $user->getUsername());
        $this->assertEquals(null, $user->getFullname());
        $this->assertEquals(null, $user->getEmail());
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
        $this->assertEquals(null, $user->getPlainPassword());
        $this->assertEquals(null, $user->isEnabled());
        $this->assertFalse($user->getJobs()->contains($data['job']));

        $this->assertEquals(null, $data['job']->getUser());

        // Test if resetting non existing relations does not cause any error
        $user->removeJob($data['job']);

        $this->assertEquals(null, $data['job']->getUser());
    }

    /**
     * Provides an optimal set of data for generating a complete entity.
     */
    public function fluentDataProvider()
    {
        return [
            [
                [
                    'username' => 'john.doe',
                    'fullname' => 'John Doe',
                    'email' => 'john.doe@incipio.fr',
                    'roles' => ['ROLE_SUPER_ADMIN'],
                    'plainPassword' => 'password',
                    'enabled' => true,
                    'job' => new Job(),
                ],
            ],
        ];
    }
}
