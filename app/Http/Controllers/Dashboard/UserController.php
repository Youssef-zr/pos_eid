<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserRequest;
use App\Http\Requests\user\EditProfileRequest;
use App\Models\Role;
use App\Traits\UploadFiles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use UploadFiles;

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only(['index']);
        $this->middleware(['permission:create_users'])->only(['create', 'store']);
        $this->middleware(['permission:update_users'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_users'])->only(['destroy']);
    }

    public function index()
    {
        $title = trans("lang.users_list");
        $auth = auth()->user();

        $query = User::query();
        if ($auth->hasRole("super_admin") == false) {
            $query = $query->whereHas(
                'roles',
                function ($q) use ($auth) {
                    $q->where('display_name', $auth->roles()->first()->display_name);
                }
            );
        }

        $users = $query->with('roles')->get();

        return view("dashboard.views.users.index", compact("users", "title"));
    }

    public function create()
    {
        $title = trans("lang.users_new");
        $roles = Role::pluck('display_name', "id")->toArray();

        return view("dashboard.views.users.create", compact("roles", "title"));
    }


    public function store(UserRequest $request)
    {
        $inputs = Arr::except($request->all(), ["confirm-password", "role"]);
        $inputs['password'] = bcrypt($inputs['password']);

        $new = new User();
        $new->fill($inputs)->save();

        $role = Role::find($request->role);
        $new->attachRoles([$role->id]);

        return redirect_with_flash("msgSuccess", trans("lang.record_added_successfully"), "users");
    }

    public function edit(User $user)
    {
        $title = trans("lang.users_edit");

        $auth = auth()->user();
        if (!$auth->hasRole("super_admin") and $user->id == 1) {
            return redirect_to_404_if_emty("");
        }

        $query = Role::query();
        if (!$auth->hasRole("super_admin")) {
            $query = $query->where('display_name', "!=", "super_admin");
        }

        $roles = $query->pluck('display_name', "id")->toArray();
        $user_role = $user->roles()->first()->id;

        return view(
            "dashboard.views.users.update",
            ["user" => $user, "roles" => $roles, "role" => $user_role, "title" => $title]
        );
    }

    public function update(UserRequest $request, $id)
    {
        $inputs = Arr::except($request->all(), ['role']);
        $inputs['password'] = bcrypt($inputs['password']);

        $user = User::find($id);
        $user->fill($inputs)->save();

        $role = Role::find($request->role);
        $user->syncRoles([$role->id]);

        return redirect_with_flash("msgSuccess", trans("lang.record_updated_successfully"), "users");
    }

    public function destroy(User $user)
    {
        $roleName = $user->roles()->first()->display_name;

        if ($roleName != "super_admin" and $user->id != 1 and auth()->id() != $user->id) {
            $user->delete();
            return redirect_with_flash("msgSuccess", trans('lang.record_deleted_successfully'), "users");
        }

        return redirect_with_flash("msgDanger", trans('lang.record_cant_deleted'), "users");
    }

    // log out
    public function logout()
    {
        Auth::logout();

        return redirect("login");
    }

    // edit profile user show page
    public function editProfile()
    {
        $title = trans('lang.update_profile');
        $user = User::find(auth()->user()->id);

        return view('dashboard.views.users.profile.show-profile', compact('user', "title"));
    }

    // update profile user
    public function updateProfile(EditProfileRequest $request, $user)
    {
        $user = User::find($user);
        $data = Arr::except($request->all(), ['photo']);

        if ($request->hasFile('photo')) {

            $imgProps = [
                "file" => $request->file('photo'),
                'storagePath' => "assets/dist/storage/users",
                "old_image" => $user->path,
                "default" => $user->file_name,
                "width" => 110,
                "height" => 110,
                "quality" => 100
            ];

            $fileInformation = UploadFiles::updateFile($imgProps);

            $data['file_name'] = $fileInformation['file_name'];
            $data['path'] = $fileInformation['file_path'];
        }

        $user->fill($data)->save();

        return redirect_with_flash("msgSuccess", trans('lang.y_profile_updated'), "user/profile/" . $user->id);
    }

    // update user profle password
    public function updatePassword(Request $request, $user)
    {
        $user = User::findOrFail($user);

        $rules = ['password' => 'required|same:confirm-password'];
        $niceNames = ['password' => trans('lang.password'), 'confirm-password' => trans('lang.confirm-password')];
        $this->validate($request, $rules, [], $niceNames);

        if ($request->password != "") {
            $user->fill(["password" => bcrypt($request->password)])->save();
            Auth::logout();
        }

        return redirect_with_flash("msgSuccess", "Votre mot de passe a été modifié avec succès", "user/profile");
    }
}
