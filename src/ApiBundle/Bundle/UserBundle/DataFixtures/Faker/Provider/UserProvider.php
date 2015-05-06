<?php

namespace ApiBundle\Bundle\UserBundle\DataFixtures\Faker\Provider;

use ApiBundle\Bundle\UserBundle\Utils\UserRoles;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;

/**
 * Class UserProvider.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class UserProvider extends BaseProvider
{
    /** @var UserRoles */
    private $userRoles;

    /** @var array */
    private $roleCount = [];

    /**
     * The first call generate unique values. This is to ensure all values are called before generating deplicates.
     *
     * @return string Random Symfony role.
     */
    public function userRole()
    {
        $roles        = $this->userRoles->getRoles();
        $returnedRole = $roles[array_rand($roles)];

        if (count($roles) !== count($this->roleCount)) {
            // Not all values have been generated yet
            // Get item that have not been used yet
            while (in_array($returnedRole, $this->roleCount)) {
                $returnedRole = $roles[array_rand($roles)];
            }
            $this->roleCount[] = $returnedRole;
        }

        return $returnedRole;
    }

    /**
     * Constructor.
     *
     * @param Generator $generator
     * @param UserRoles $userRoles
     */
    public function __construct(Generator $generator, UserRoles $userRoles)
    {
        parent::__construct($generator);

        $this->userRoles = $userRoles;
    }
}
