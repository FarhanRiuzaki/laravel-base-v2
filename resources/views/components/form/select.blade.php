<div class="form-group">
    @php
        $cek = 'form-control select2' . $class;
        if($errors->has($name)){
            $cek = 'form-control select2' . $class . \isValid($errors->has($name)) ;
        }
    @endphp
    {{ Form::label($label, null, ['class' => 'control-label']) }}
    {!! Form::select($name,$value,$default,array_merge(['class'=>$cek,'id'=>$name],$attributes)); !!}
    <p class="invalid-feedback">{{ $errors->first($name) }}</p>
</div>