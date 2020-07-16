<?php

namespace App;

use App\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use RecordSignature;

    protected $fillable = [
        'cif', 'code_product', 'name', 'maturity_date', 'currency', 'limit','description', 'flag_id', 'note'
    ];

    public function cifmast()
    {
        return $this->belongsTo(MasterCifmast::class, 'cif', 'CIFNO');
    }

    public function flag()
    {
        return $this->belongsTo(MasterFlag::class);
    }
}
