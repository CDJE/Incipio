<?php

namespace ApiBundle\Utils;

/**
 * Class UserRoles.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class UserRoles
{
    /**
     * @var array Hierarchy of roles registered by the Security component.
     *
     * @see Symfony\Component\Security\Core\Role\RoleHierarchy
     */
    private $hierarchy;

    /**
     * @param array $hierarchy Hierarchy of registered roles
     */
    public function __construct(array $hierarchy)
    {
        $this->hierarchy = $hierarchy;
    }

    /**
     * @return array list of registered roles
     */
    public function getRoles()
    {
        // Flatten array to get all its values
        $roles = $this->flattenArray($this->hierarchy);

        return array_unique($roles);
    }

    /**
     * Flatten the given array including the key of the arrays inside.
     *
     * Warning: has been tested only on arrays with the same structure as hierarchy! For instance, if an inner array
     * has no key, the result we be something like `0 => 0` (new key of the flattened array => the key of the inner
     * array).
     *
     * @param array $array Array to flatten.
     *
     * @return array Flattened array.
     */
    private function flattenArray(array $array)
    {
        $return = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return[] = $key;
                $return = array_merge($return, $this->flattenArray($value));
            } else {
                $return[$key] = $value;
            }
        }

        return $return;
    }
}
