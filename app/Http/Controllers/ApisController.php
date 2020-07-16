<?php

namespace App\Http\Controllers;

use App\Imports\Mt700Import;
use App\MasterBranch;
use App\MasterFlag;
use App\Mt700;
use App\Transactions;
use App\TransactionsFile;
use Illuminate\Http\Request;
use PDF;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Mt707;

class ApisController extends Controller
{
    public function cif(Request $req)
    {
        $cif = DB::table('master_cifmast')
            ->where('CIFNO', 'LIKE', '%' . $req->name .'%')
            ->orWhere('CFSNME', 'LIKE', '%' . $req->name .'%')
            ->orderBy('CIFNO', 'ASC')
            ->get();

        $data = [];
        foreach($cif as $key => $val){
            $data[$key]['code'] = $val->CIFNO;
            $data[$key]['name'] = $val->CFSNME;
            $data[$key]['address'] = $val->CFNA2 . ' '. $val->CFNA3 . ' ' . $val->CFNA4 . ' ' . $val->CFNA5;
            $data[$key]['address'] = substr($data[$key]['address'], 1, 30);

            $data[$key]['cfna1']    = $val->CFNA1;
            $data[$key]['telp']     = $val->CFTLPN;
            $data[$key]['api']      = $val->CFAPI;
            $data[$key]['npwp']     = $val->CFNPWP;
            $data[$key]['memo']     = $val->MEMO;
        }

        return response()->json($data);

    }

    public function lc_code(Request $req)
    {
        if($req->ajax()){
            $prefix = 'LLN';
            if(!empty($req->lc)){
                if($req->lc == 'LC'){
                    $prefix = 'LLN';
                }elseif ($req->lc == 'SKBDN') {
                    $prefix = 'LDN';
                }
            }

            $branch         = \Auth::user()->branch;
            if(!empty($req->branch)){
                $branch = MasterBranch::find($req->branch);
                $branch = $branch->code;
            }

            $code_reg       = Transactions::
            select(DB::raw('IFNULL(MAX(SUBSTR(code_reg, -11,4)), 0) + 1 as code'))
            ->whereRaw('SUBSTR(code_reg, -6, 3) = "' . $branch . '" AND SUBSTR(code_reg, -2,2) = "' . date('y') .'"')->first();

            if($code_reg->code < 10){
                $count = '000' . $code_reg->code;
            }elseif ($code_reg->code < 100) {
                $count = '00' . $code_reg->code;
            }elseif ($code_reg->code < 1000) {
                $count = '0' . $code_reg->code;
            }

            $code = $prefix . '/' . $count . '/' . $branch . '/' . date('y');

            return response()->json($code);
        }
    }

    public function mt700(Request $req)
    {
        // cek transaksi
        $lc_data = Transactions::pluck('lc_code');

        $mt700 = Mt700::orderBy('updated_at', 'desc')->paginate(15);
        // jika ada search
        if($req->input){
            $mt700 = Mt700::whereRaw('LC_CODE LIKE "%' . $req->input . '%"')->orderBy('updated_at', 'desc')->get();
        }
        // jika ada di transaksi
        if($lc_data){
            $mt700 = Mt700::whereNotIn('LC_CODE', $lc_data)->orderBy('updated_at', 'desc')->paginate(10);
            // jika ada search
            if($req->input){
                $mt700 = Mt700::whereRaw('LC_CODE LIKE "%' . $req->input . '%"')->whereNotIn('LC_CODE', $lc_data)->orderBy('updated_at', 'desc')->get();
            }
        }

        return response()->json($mt700);

    }

    public function mt707(Request $req)
    {
        // cek transaksi
        $lc_data = Transactions::pluck('lc_code');

        $mt707 = Mt707::orderBy('updated_at', 'desc')->paginate(15);
        // jika ada search
        if($req->input){
            $mt707 = Mt707::whereRaw('LC_CODE LIKE "%' . $req->input . '%"')->orderBy('updated_at', 'desc')->get();
        }
        // jika ada di transaksi
        if($lc_data){
            $mt707 = Mt707::whereNotIn('LC_CODE', $lc_data)->orderBy('updated_at', 'desc')->paginate(10);
            // jika ada search
            if($req->input){
                $mt707 = Mt707::whereRaw('LC_CODE LIKE "%' . $req->input . '%"')->whereNotIn('LC_CODE', $lc_data)->orderBy('updated_at', 'desc')->get();
            }
        }

        return response()->json($mt707);

    }

    public function get_lc($id = null, Request $req)
    {
        $lc = $req->search;
        // dd($lc);
        $record = Transactions::where('lc_code', 'like', '%' . $lc . '%')->get();

        $data = [];
        foreach($record as $key => $val){
            $data[$key]['text'] = $val->lc_code;
            $data[$key]['id']   = $val->id;
        }

        return response()->json($data);
    }

    // PDF
    public function pdfNotifLetter($id)
    {
        $record = Transactions::with(['mt700' => function($que){
            $que->select('transactions_mt700.transaction_id', 'transactions_mt700.*', DB::raw("MAKEDATE(LEFT(CONCAT('20',  C31C),4) ,CONCAT('20',  C31C) % 1000) as C31C"));
        }, 'document','branchs'])->find($id);
        // dd($record);
        $pdf    = PDF::loadView('advise.maker.pdf.NotifLetter', compact('record'));

        return $pdf->stream('Notification Letter - ' . $record->code . ' - ' . date('Ymd') . '.pdf');
        // return view('advise.maker.NotifLetter', compact('record'));
    }

    public function pdfNotaDebet($id)
    {
        $record = Transactions::with('mt700', 'document','branchs','cifmast')->find($id);

        $pdf    = PDF::loadView('advise.maker.pdf.NotaDebet', compact('record'));

        return $pdf->stream('Nota Debet - ' . $record->code . ' - ' . date('Ymd') . '.pdf');
        // return view('advise.maker.NotifLetter', compact('record'));
    }
    // END PDF
    public function importExcel()
    {
        # code...
        // validasi
        $file = public_path() . "/mt700.xlsx";
        // dd($file);
		// import data
        $array = Excel::toArray(new Mt700Import, $file);

        $data = [];
        $no = 0;
        foreach (array_slice($array[0], 1) as $key => $val) {
            if($val[2] != ""){
                $data['LC_CODE']   = trim($val[2]);
                $data['C27']   = trim($val[0]);
                $data['C40A']  = trim($val[1]);
                $data['C20']   = trim($val[2]);
                $data['C31C']  = trim($val[3]);
                $data['C40E']  = trim($val[4]);
                $data['C31D']  = trim($val[5]);
                $data['C51D']  = trim($val[6]);
                $data['C51A']  = trim($val[7]);
                $data['C50']   = trim($val[8]);
                $data['C59']   = trim($val[9]);
                $data['C32B']  = trim($val[10]);
                $data['C39A']  = trim($val[11]);
                $data['C41D']  = trim($val[12]);
                $data['C42C']  = trim($val[13]);
                $data['C42A']  = trim($val[14]);
                $data['C42D']  = trim($val[15]);
                $data['C43P']  = trim($val[16]);
                $data['C43T']  = trim($val[17]);
                $data['C44E']  = trim($val[18]);
                $data['C44F']  = trim($val[19]);
                $data['C44C']  = trim($val[20]);
                $data['C45A']  = trim($val[21]);
                $data['C46A']  = trim($val[22]);
                $data['C47A']  = trim($val[23]);
                $data['C71B']  = trim($val[24]);
                $data['C48']   = trim($val[25]);
                $data['C49']   = trim($val[26]);
                $data['C53A']  = trim($val[27]);
                $data['C53D']  = trim($val[28]);
                $data['C78']   = trim($val[29]);
                $data['C57A']  = trim($val[30]);
                $data['C57D']  = trim($val[31]);
                $data['C72']   = trim($val[32]);

                $save = Mt700::create($data);
                $save = Mt707::create($data);
                $no++;
            }
        }


		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		// return redirect('/siswa');
    }
}
