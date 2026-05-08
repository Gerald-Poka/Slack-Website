<?php

namespace App\Modules\Auth;

class RoleService
{
    /**
     * Assign specific permissions to a user, allowing for granular
     * control even among users with the same role.
     */
    public function syncUserPermissions($user, array $permissions)
    {
        // Spatie sync logic
    }
}
