<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function user_groups()
    {
        $user_groups = UserGroup::all();

        return view('users.user_groups')->with([
            'user_groups' => $user_groups,
        ]);
    }

    public function new_user_group(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:user_groups,name',
        ]);


        $user_group = new UserGroup();
        $user_group->name = $request->name;
        $user_group->saveOrFail();


        Session::flash("success", "Group has been created");


        return redirect()->back();
    }
    public function get_group_details($id)
    {

        return UserGroup::find($id);
    }
    public function update_group_details(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:user_groups,id',
            'name' => 'required|unique:user_groups,name',
        ]);


        $user_group = UserGroup::find($request->id);
        $user_group->name = $request->name;
        $user_group->update();


        Session::flash("success", "Group has been updated");


        return redirect()->back();
    }
    public function delete_group(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:user_groups,id',
        ]);


        $user_group = UserGroup::find($request->id);
        $user_group->delete();


        Session::flash("success", "Group has been deleted");


        return redirect()->back();
    }

    public function user_group_details($_id)
    {
        $ug = UserGroup::find($_id);

        if(is_null($ug))
            abort(404);

        $users = User::where('user_group',$_id)->get();

        $user_permissions = UserPermission::where('group_id',$_id)->get();



        return view('users.group_details')->with([
            'group' => $ug,
            'users' => $users,
            'user_permissions' => $user_permissions
        ]);

    }
    public function add_group_permission(Request $request)
    {
        $this->validate($request, [
            'permission' => 'bail|required',
            'group_id' => 'bail|required',
        ]);

        foreach ($_POST['permission'] as $perm) {
            $userPermission = new userPermission();
            $userPermission->group_id = $request->group_id;
            $userPermission->permission_id = $perm;
            $userPermission->saveOrFail();
        }

        request()->session()->flash('success', 'Permissions added successfully');

        return redirect()->back();
    }
    public function delete_group_permission($group_id)
    {
        $userPermission = UserPermission::find($group_id);
        if ($data = $userPermission->delete()) {
            request()->session()->flash("success", "Permission deleted successfully.");
        }
        return redirect()->back();
    }

}
