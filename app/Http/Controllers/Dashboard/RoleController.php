<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\role\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['permission:read_roles'])->only(['index']);
        $this->middleware(['permission:create_roles'])->only(['create', 'store']);
        // $this->middleware(['permission:update_roles'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_roles'])->only(['destroy']);
    }

    public function index()
    {
        $title = trans('lang.roles_list');
        $auth = auth()->user();

        $query = Role::query();
        if (!$auth->hasRole("super_admin")) {
            $query = $query->where('display_name', "!=", "super_admin");
        }

        $roles = $query->get();

        return view('dashboard.views.roles.index', compact("roles", "title"));
    }

    public function create()
    {
        $title = trans('lang.create');

        return view('dashboard.views.roles.create', compact('title'));
    }

    public function store(RoleRequest $request)
    {
        $role = new Role();
        $this->updateRolePermissions($role, $request);

        return redirect_with_flash("msgSuccess", trans("lang.record_added_successfully"), "roles");
    }

    public function edit(Role $role)
    {
        $title = trans('lang.update');
        $auth = auth()->user();

        $query = Role::query();
        if (!$auth->hasRole("super_admin") and $role->display_name == "super_admin") {
            return redirect_to_404_if_emty("");
        }

        return view('dashboard.views.roles.update', compact("role", 'title'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->updateRolePermissions($role, $request);

        return redirect_with_flash("msgSuccess", trans("lang.record_updated_successfully"), "roles");
    }

    public function destroy(Role $role)
    {
        if ($role->id == 1) {
            return redirect_to_404_if_emty("");
        }

        return redirect_with_flash("msgSuccess", trans("lang.record_deleted_successfully"), "roles");
    }


    // create or update role and async permissions
    public function updateRolePermissions($role, $request)
    {
        $inputs = $request->except("permissions");

        // create or update role
        $data['name'] = str_replace(' ', '_', $inputs['name']);
        $data['display_name'] = strtolower(str_replace(' ', '_', $inputs['name']));
        $data['description'] = $inputs['description'];
        $role->fill($data)->save();

        // async permissions
        $permissionsReq = $request->permissions;
        $permissions = [];

        if ($permissionsReq != []) {

            foreach ($permissionsReq as $perm) {
                $permissions[] =  Permission::updateOrCreate([
                    'name' => $perm,
                    'display_name' => ucwords(str_replace(' ', '-', $perm)),
                    'description' => $perm
                ])->id;
            }
        }

        // async role permissions
        $role->syncPermissions($permissions);
    }
}
