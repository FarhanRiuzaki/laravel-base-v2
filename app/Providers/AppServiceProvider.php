<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Apps;
use Illuminate\Support\Facades\View;
use Form;
use Illuminate\Support\Facades\Blade;
use DebugBar;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $appSetting = Apps::orderBy('created_at', 'DESC')->first();

        // DEFINE FORM 
        // array 1 : label
        // array 2 : nama & id
        // array 3 : value isinya
        // array 4 : class
        // array 5 : attribute
        Form::component('inputText', 'components.form.text',                ['label', 'name', 'value' => null, 'class',  'attributes' => []]);
        Form::component('inputTextRow', 'components.form.textRow',          ['label', 'name', 'value' => null, 'class',  'attributes' => []]);
        Form::component('inputTextarea', 'components.form.textarea',        ['label', 'name', 'value' => null, 'class',  'attributes' => []]);
        Form::component('inputTextareaRow', 'components.form.textareaRow',  ['label', 'name', 'value' => null, 'class',  'attributes' => []]);
        Form::component('inputNumber', 'components.form.number',            ['label', 'name', 'value' => null, 'class',  'attributes' => []]);
        Form::component('inputSelect', 'components.form.select',            ['label', 'name', 'value' => [],  'class', 'attributes' => [], 'default' => null]);
        
        // DEFINE CARD
        Blade::component('components.card', 'card');

        Blade::component('components.breadcrumb', 'breadcrumb');

        View::share('appSetting', $appSetting);
    }
}
