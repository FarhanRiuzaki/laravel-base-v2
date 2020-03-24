<?php

namespace App\Http\Controllers;

use App\MasterBranch;
use App\MasterFlag;
use App\Transactions;
use App\TransactionsFile;
use Illuminate\Http\Request;
use DB;

class ApisController extends Controller
{
    public function cif(Request $req)
    {
        $cif = DB::table('cifmast')
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
}
