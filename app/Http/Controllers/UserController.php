<?php

namespace App\Http\Controllers;

use App\Models\Product;
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



    public function users() {
        $users = User::all();
        $userGroups = UserGroup::all();

        return view('users.users')->with([
            'users' => $users,
            'userGroups' => $userGroups,
        ]);
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function update_user(Request $request)
    {
        $data = request()->validate([
            'id' => 'required',
            'user_group' => 'required',
            'email' => 'required|email|max:255|unique:users,email,'.$request->id,
            'name' => 'required',
        ]);

        User::where('id', $request->id)->update($data);

        request()->session()->flash('success', 'User has been updated.');
        return redirect()->back();
    }

    public function register_user(Request $request)
    {
        $this->validate($request, [
            'user_group' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'name' => 'required',
        ]);


        $random_pass = $this->randomPassword();

        $user = new User();
        $user->name = $request->name;
        $user->user_group = $request->user_group;
        $user->email = $request->email;
        $user->password = bcrypt($random_pass);
        $user->saveOrFail();

       Session::flash("success", "User has been created");

        return redirect()->back();
    }

    public function delete_user(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $user = User::find($request->user_id);
            $user->delete();
            request()->session()->flash('success', 'User has been deleted successfully!');

        }catch (\Exception $exception){
            request()->session()->flash('warning', "Can not delete user because it is being used in the system");
//            request()->session()->flash('warning', $exception->getMessage());
        }


        return redirect()->back();
    }







    public function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }


}
