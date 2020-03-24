<div class="form-group">
    @php
        $cek = 'form-control' . $class;
        if($errors->has($name)){
            $cek = 'form-control' . $class . isValid($errors->has($name)) ;
        }
    @endphp
    <div class="row">
        <div class="col-md-3">
            {{ Form::label($label, null, ['class' => 'control-label']) }}
        </div>
        <div class="col-md-9">
            {{ Form::textarea($name, $value, array_merge(['class' => $cek, 'id' => $name, 'rows' => '5'], $attributes)) }}
            <p class="invalid-feedback">{{ $errors->first($name) }}</p>
        </div>
    </div>
</div>