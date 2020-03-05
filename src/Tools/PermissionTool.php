<?php

namespace SpaceCode\Maia\Tools;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use SpaceCode\Maia\Permission;
use SpaceCode\Maia\Role;

class PermissionTool extends Tool
{
    public $roleResource = Role::class;
    public $permissionResource = Permission::class;
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            $this->roleResource,
            $this->permissionResource,
        ]);
    }
    public function roleResource(string $roleResource)
    {
        $this->roleResource = $roleResource;
        return $this;
    }
    public function permissionResource(string $permissionResource)
    {
        $this->permissionResource = $permissionResource;
        return $this;
    }
}