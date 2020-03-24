<?php

namespace App\Traits;

use app\Observers\ModelObserver;

trait RecordSignature
{

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->updated_by = \Auth::User()->id;
        });

        static::creating(function ($model) {
            
            $model->created_by = \Auth::User()->id;
            // dd($model);
        });
        //etc

    }
}