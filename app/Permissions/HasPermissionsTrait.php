<?php


namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

trait HasPermissionsTrait
{

    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function withdrawPermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function giveRolesTo(... $roles)
    {
        $roles = $this->getAllRoles($roles);

        if ($roles === null) {
            return $this;
        }
        $this->roles()->saveMany($roles);
        return $this;
    }

    public function withdrawRolesTo(... $roles)
    {
        $roles = $this->getAllRoles($roles);
        $this->roles()->detach($roles);
        return $this;
    }

    public function refreshPermissions(... $permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionThroughRole($permission) {

        $permission = DB::table('roles_permissions')
            ->join('permissions', 'permissions.id', '=', 'roles_permissions.permission_id')
            ->join('roles', 'roles.id', '=', 'roles_permissions.role_id')
            ->where('permissions.slug', $permission)
            ->get();

        foreach ($permission as $role){
            if($this->hasRole($role->slug)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole(... $roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function getRole()
    {
        $rolesList = Role::all();

        $max = null;

        foreach ($rolesList as $role)
        {
            if($this->hasRole($role->slug))
            {
                $max = $role;
            }
        }

        return $max;

    }

    public function getRoles() {

        $rolesList = Role::all();

        $list = [];

        foreach ($rolesList as $role)
        {
            if($this->hasRole($role->slug))
            {
                array_push($list, $role->slug);
            }
        }

        return $list;

    }

    public function viewRole() {

        $role = $this->getRole();

        return View::make('template/role', [
            'class' => $role->slug,
            'label' => $role->name
        ]);

    }

    public function hasPermission($permission)
    {
        return (bool)$this->permissions->where('slug', $permission)->count();
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    protected function getAllRoles(array $roles)
    {
        return Role::whereIn('slug', $roles)->get();
    }

}
