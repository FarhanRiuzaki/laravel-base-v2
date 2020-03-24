<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use DebugBar;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        // AJAX
        if($request->ajax())
        {
            $data = Role::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($user) {
                        return $user->created_at ? $user->created_at->format('m-d-Y') : '';
                    })
                    ->addColumn('action', function($data){
                        $button = '';
                        if($data->id != '99'){
                            $button .= '<button type="button" class="btn btn-danger btn-sm btn-delete" data-remote="'. route('roles.destroy', $data->id) .'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></button>';
                        }
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $roles = Role::orderBy('created_at', 'DESC')->paginate(10);

        return view('roles.index', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);
    
        $role = Role::firstOrCreate(['name' => $request->name]);
        return redirect()->back()->with(['success' => 'Role: ' . $role->name . ' Ditambahkan']);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        
        if($role->delete()){
            return response()->json(['code' => 'success', 'msg' => 'Data berhasil di hapus']);
        }else{
            return response()->json(['code' => 'error', 'msg' => 'Terjadi kesalahan!']);
        }
    }
}
