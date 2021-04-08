<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin', [
            'users' => User::all(),
            'permissions' => Permission::all(),
            'roles' => Role::all()
        ]);
    }

    public function showPermissions(User $user)
    {
        return view('admin.showPerms', [
            'user' => $user,
            'permissions' => Permission::all(),
            'roles' => Role::all()
        ]);
    }

    public function showRole(Role $role)
    {
        return view('admin.showRole', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    public function deleteUser(User $user)
    {
        foreach ($user->permissions as $p)
        {
            $user->withdrawPermissionsTo($p->slug);
        }

        foreach ($user->roles as $r)
        {
            $user->withdrawRolesTo($r->slug);
        }

        $user->delete();

        return redirect()->route('admin')->with([
            'message' =>[
                'title' => 'Administrateur',
                'message' => 'Un utilisateur a bien été supprimé.'
            ]
        ]);
    }

    public function deleteRole(Role $role)
    {
        if (count($role->users) > 0)
        {
            return back()->with([
                'message' =>[
                    'title' => 'Administrateur',
                    'message' => 'Un utilisateur possède ce role vous ne pouvez pas le supprimer.'
                ]
            ]);
        }
        else
        {
            $role->delete();

            return redirect()->route('admin')->with([
                'message' =>[
                    'title' => 'Administrateur',
                    'message' => 'Un rôle a bien été supprimé.'
                ]
            ]);
        }
    }

    public function createRole(Request $request)
    {
        Role::create($request->validate([
            'slug' => 'required',
            'name' => 'required'
        ]));

        return redirect()->route('admin')->with([
            'message' =>[
                'title' => 'Administrateur',
                'message' => 'Un rôle a bien été ajouté.'
            ]
        ]);
    }

    public function updateRole(Request $request, Role $role)
    {
        $this->permissionsUpdate($request, $role);

        return redirect()->route('admin.roles', $role->id)->with([
            'message' =>[
                'title' => 'Administrateur',
                'message' => 'Les permissions ont été mises à jour.'
            ]
        ]);
    }

    public function updatePermissions(Request $request, User $user)
    {
        $this->permissionsUpdate($request, $user);

        return redirect()->route('admin.user.permissions', $user->id)->with([
            'message' =>[
                'title' => 'Administrateur',
                'message' => 'Les permissions ont été mises à jour.'
            ]
        ]);
    }

    public function updateRoles(Request $request, User $user)
    {
        $data = $request->validate([
            'roles' => 'nullable',
            'removeAllRoles' => 'nullable'
        ]);

        $removedRoles = [];

        if (array_key_exists('removeAllRoles', $data))
        {
            foreach ($user->roles as $r)
            {
                $removedRoles[] = $r->slug;
            }
        }
        else
        {
            foreach ($user->roles as $r)
            {
                if (array_key_exists('roles', $data))
                {
                    if (!in_array($r->slug, $data['roles']))
                    {
                        $removedRoles[] = $r->slug;
                    }
                    else
                    {
                        if (($key = array_search($r->slug, $data['roles'])) !== false) {
                            unset($data['roles'][$key]);
                        }
                    }
                }
            }

            if (array_key_exists('roles', $data) && count($data['roles']) > 0)
            {
                foreach ($data['roles'] as $role)
                {
                    $user->giveRolesTo($role);
                }
            }
        }

        if (count($removedRoles) > 0)
        {
            foreach ($removedRoles as $role)
            {
                $user->withdrawRolesTo($role);
            }
        }

        return redirect()->route('admin.user.permissions', $user->id)->with([
            'message' =>[
                'title' => 'Administrateur',
                'message' => 'Les roles ont été mises à jour.'
            ]
        ]);
    }

    private function permissionsUpdate(Request $request, Model $model)
    {
        $data = $request->validate([
            'perms' => 'nullable',
            'removeAllPerms' => 'nullable'
        ]);

        $removedPermissions = [];

        if (array_key_exists('removeAllPerms', $data))
        {
            foreach ($model->permissions as $p)
            {
                $removedPermissions[] = $p->slug;
            }
        }
        else
        {
            foreach ($model->permissions as $p)
            {
                if (array_key_exists('perms', $data))
                {
                    if (!in_array($p->slug, $data['perms']))
                    {
                        $removedPermissions[] = $p->slug;
                    }
                    else
                    {
                        if (($key = array_search($p->slug, $data['perms'])) !== false) {
                            unset($data['perms'][$key]);
                        }
                    }
                }
            }

            if (array_key_exists('perms', $data) && count($data['perms']) > 0)
            {
                foreach ($data['perms'] as $perm)
                {
                    $model->givePermissionsTo($perm);
                }
            }
        }

        if (count($removedPermissions) > 0)
        {
            foreach ($removedPermissions as $perm)
            {
                $model->withdrawPermissionsTo($perm);
            }
        }
    }
}
