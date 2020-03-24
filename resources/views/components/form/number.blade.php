<div class="form-group">
    @php
        $cek = 'form-control' . $class;
        if($errors->has($name)){
            $cek = 'form-control' . $class . isValid($errors->has($name)) ;
        }
    @endphp
    {{ Form::label($label, null, ['class' => 'control-label']) }}
    {{ Form::number($name, $value, array_merge(['class' => $cek, 'id' => $name], $attributes)) }}
    <p class="invalid-feedback">{{ $errors->first($name) }}</p>
</div>