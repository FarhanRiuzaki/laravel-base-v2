<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use Spatie\Permission\Models\Permission;
use DB;
use DataTables;

class UserController extends Controller
{
    public function index()
    {

        $users = User::orderBy('created_at', 'DESC')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if($request->status == 'on'){
            $request->status = '1';
        }else{
            $request->status = '0';
        }

        $this->validate($request, [
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'role'      => 'required|string|exists:roles,name'
        ]);

        $user = User::firstOrCreate([
            'email'     => $request->email
        ], [
            'name'      => $request->name,
            'password'  => bcrypt($request->password),
            'status'    => $request->status
        ]);

        $user->assignRole($request->role);
        return redirect(route('users.index'))->with(['success' => 'User: ' . $user->name . ' Ditambahkan']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if($request->status == 'on'){
            $request->status = '1';
        }else{
            $request->status = '0';
        }

        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'name'      => $request->name,
            'password'  => $password,
            'status'    => $request->status,
        ]);
        return redirect(route('users.index'))->with(['success' => 'User: ' . $user->name . ' Diperbaharui']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->delete()){
            return response()->json(['code' => 'success', 'msg' => 'Data berhasil di hapus']);
        }else{
            return response()->json(['code' => 'error', 'msg' => 'Terjadi kesalahan!']);
        }
    }

    // ROLE
    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        
        //Default, set dua buah variable dengan nilai null
        $permissions = null;
        $hasPermission = null;
        
        //Mengambil data role
        $roles = Role::all()->pluck('name');
        
        //apabila parameter role terpenuhi
        if (!empty($role)) {
            //select role berdasarkan namenya, ini sejenis dengan method find()
            $getRole = Role::findByName($role);
            // dd($getRole);
            
            //Query untuk mengambil permission yang telah dimiliki oleh role terkait
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            
            // if($getRole->id == '99'){
            //     $permissions = Permission::whereNotIn('id', [2,3,4,5])->pluck('name');
            // }else{
                //Mengambil data permission
                $permissions = Permission::all()->pluck('name');
            // }
        }
        return view('users.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function addPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);
    
        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);
        return redirect()->back();
    }

    public function setRolePermission(Request $request, $role)
    {
        //select role berdasarkan namanya
        $role = Role::findByName($role);
        
        //fungsi syncPermission akan menghapus semua permissio yg dimiliki role tersebut
        //kemudian di-assign kembali sehingga tidak terjadi duplicate data
        $role->syncPermissions($request->permission);
        return redirect()->back()->with(['success' => 'Role Permission berhasil disimpan']);
    }

    public function roles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all()->pluck('name');
        return view('users.roles', compact('user', 'roles'));
    }

    public function setRole(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required'
        ]);
    
        $user = User::findOrFail($id);
        //menggunakan syncRoles agar terlebih dahulu menghapus semua role yang dimiliki
        //kemudian di-set kembali agar tidak terjadi duplicate
        $user->syncRoles($request->role);
        return redirect(route('users.index'))->with(['success' => 'Role Sudah Di Set']);
    }

    // Setting User
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('vendor.user_setting', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|exists:users,email',
            'password'  => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'name' => $request->name,
            'password' => $password
        ]);
        return redirect(route('home'))->with(['success' => 'Akun Berhasil diperbaharui']);
    }
}
