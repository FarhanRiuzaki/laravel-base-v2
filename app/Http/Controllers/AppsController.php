<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apps;
use Illuminate\Support\Str;
use File;
use SweetAlert;

class AppsController extends Controller
{
    public function index($id = null)
    {
        //BUAT QUERY KE DATABASE MENGGUNAKAN MODEL CATEGORY DENGAN MENGURUTKAN BERDASARKAN CREATED_AT DAN DISET DESCENDING, KEMUDIAN PAGINATE(10) BERARTI HANYA ME-LOAD 10 DATA PER PAGENYA
        //YANG MENARIK ADALAH FUNGSI WITH(), DIMANA FUNGSI INI DISEBUT EAGER LOADING
        //ADAPUN NAMA YANG DISEBUTKAN DIDALAMNYA ADALAH NAMA METHOD YANG DIDEFINISIKAN DIDALAM MODEL CATEGORY
        //METHOD TERSEBUT BERISI FUNGSI RELATIONSHIPS ANTAR TABLE
        //JIKA LEBIH DARI 1 MAKA DAPAT DIPISAHKAN DENGAN KOMA, 
        // CONTOH: with(['parent', 'contoh1', 'contoh2'])
        $apps = Apps::orderBy('created_at', 'DESC')->first();
      
        //LOAD VIEW DARI FOLDER CATEGORIES, DAN DIDALAMNYA ADA FILE INDEX.BLADE.PHP
        //KEMUDIAN PASSING DATA DARI VARIABLE $category & $parent KE VIEW AGAR DAPAT DIGUNAKAN PADA VIEW TERKAIT
        return view('apps.index', compact('apps'));
    }

    public function update(Request $request, $id)
    {
        //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'name'          => 'required|string|max:100',
            'desc'          => 'required',
            'image_login'   => 'nullable|image|mimes:png,jpeg,jpg', //IMAGE BISA NULLABLE
            'image_header'  => 'nullable|image|mimes:png,jpeg,jpg', //IMAGE BISA NULLABLE
            'image_icon'    => 'nullable|image|mimes:png,jpeg,jpg', //IMAGE BISA NULLABLE
        ]);

        $apps           = Apps::find($id); //AMBIL DATA PRODUK YANG AKAN DIEDIT BERDASARKAN ID
        $image_login    = $apps->image_login; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI
        $image_header   = $apps->image_header; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI
        $image_icon     = $apps->image_icon; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI
    
        //JIKA ADA FILE GAMBAR YANG DIKIRIM IMAGE LOGIN
        if ($request->hasFile('image_login')) {
            $file = $request->file('image_login');
            $image_login =  time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            //MAKA UPLOAD FILE TERSEBUT
            $file->storeAs('public/images', $image_login);
            //DAN HAPUS FILE GAMBAR YANG LAMA
            File::delete(storage_path('app/public/images/' . $apps->image_login));
        }

        //JIKA ADA FILE GAMBAR YANG DIKIRIM IMAGE HEADER
        if ($request->hasFile('image_header')) {
            $file = $request->file('image_header');
            $image_header =  time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            //MAKA UPLOAD FILE TERSEBUT
            $file->storeAs('public/images', $image_header);
            //DAN HAPUS FILE GAMBAR YANG LAMA
            File::delete(storage_path('app/public/images/' . $apps->image_header));
        }

        //JIKA ADA FILE GAMBAR YANG DIKIRIM IMAGE HEADER
        if ($request->hasFile('image_icon')) {
            $file = $request->file('image_icon');
            $image_icon =  time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            //MAKA UPLOAD FILE TERSEBUT
            $file->storeAs('public/images', $image_icon);
            //DAN HAPUS FILE GAMBAR YANG LAMA
            File::delete(storage_path('app/public/images/' . $apps->image_icon));
        }

            //KEMUDIAN UPDATE PRODUK TERSEBUT
            $apps->update([
                'name'          => $request->name,
                'desc'          => $request->desc,
                'image_login'   => $image_login,
                'image_header'  => $image_header,
                'image_icon'    => $image_icon,
            ]);

        return redirect(route('apps.index'))->with(['success' => 'Data Aplikasi Terupdate']);
    }

    public function theme(Request $req)
    {
        $apps               = Apps::orderBy('id', 'DESC')->first();; //AMBIL DATA PRODUK YANG AKAN DIEDIT BERDASARKAN ID

        //KEMUDIAN UPDATE PRODUK TERSEBUT
        $apps->update([
            'theme'         => $req->theme,
        ]);
    }
}
