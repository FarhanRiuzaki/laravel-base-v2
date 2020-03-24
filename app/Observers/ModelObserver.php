<?php

namespace App\Observers;

class ModelObserver
{
    protected $userID;

    public function __construct(){
        $this->userID =  Auth::id();
    }


    public function updating($model)
    {
        $model->updated_by = $this->userID;
    }


    public function creating($model)
    {
        $model->created_by = $this->userID;
    }
}
