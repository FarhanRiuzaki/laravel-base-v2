<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordSignature;

class Apps extends Model
{
    use RecordSignature;
    
    protected $guarded = [];
}
