<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{

    // public function impersonate($id)
    // {
    //     $user = User::find($id);
    //     if($user){
    //         Session::put('impersonate',$user->id);
    //     }
    //     return redirect('/');
    // }
    public function index()
    {
        // Role::create(['name' => 'admin']);
        // Permission::create(['name' => 'add movie']);
        // $role = Role::find('1');
        // $permission = Permission::find('1');
        // $role->givePermisssionTo($permission);
        // $role->revokePermissionTO($permission);
        // auth()->user()->givePermissionTo('edit movie');
        // return auth()->user()->permissions;
        // return auth()->user()->getDirectPermissions();
        // return auth()->user()->getAllPermissions();
        // return auth()->user()->getPermissionViaRoles();
        // return User::role('admin')->get();
        // return User::permission('add movie')->get();
        // $user = User::with('roles','permissions')->orderby('id','DESC')->get();
        $list = User::orderby('id', 'DESC')->get();
        return view('admincp.user.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(1);
        return view('admincp.user.form', compact('user'));
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('admincp.user.profile', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',

                'email' => 'required|max:255',
                // 'image' =>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'password' => 'required',
            ],
            [
                'name.unique' => 'Tên tài khoảnđã có ,xin điền tên khác',

                'name.required' => 'Vui lòng điền tên tài khoản!',

                'email.required' => 'Vui lòng điền mô tả tài khoản!',
                'password.required' => 'Vui lòng chọn trạng thái tài khoản!',

            ]
        );


        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();
        toastr()->success('Thành công', 'Thêm tài khoản thành công.');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        // $list = User::orderBy('position','ASC')->get();
        return view('admincp.user.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:categories|max:255',
                'email' => 'required||max:255',
                // 'image' =>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'password' => 'required',
            ],
            [
                'name.unique' => 'Tên tài khoảnđã có ,xin điền tên khác',
                'name.required' => 'Vui lòng điền tên tài khoản!',
                'email.required' => 'Vui lòng điền mô tả tài khoản!',
                'password.required' => 'Vui lòng chọn trạng thái tài khoản!',

            ]
        );


        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        toastr()->success('Thành công', 'Thêm tài khoản thành công.');
        return redirect()->route('user.profile');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $data = $request->all();

        $user = User::find($id);
        $user->name = $data['name'];
        $user->email =$data['email'];
        $user->save();

        return back()->with('success', 'Thông tin tài khoản đã được cập nhật thành công.');
    }

    // Phương thức cho việc thay đổi mật khẩu
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        $data = $request->all();
        // dd($data['new_password']);
        $user = User::find($id);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Mật khẩu đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        toastr()->info('Thành công', 'Xoá tài khoản thành công.');
        return redirect()->route('user.index');
    }
}
