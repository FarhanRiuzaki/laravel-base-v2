<div class="form-group">
    @php
        $cek = 'form-control' . $class;
        if($errors->has($name)){
            $cek = 'form-control' . $class . isValid($errors->has($name)) ;
        }
    @endphp
    <div class="row">
        @if ($label)
            
        <div class="col-md-3">
            {{ Form::label($label, null, ['class' => 'control-label']) }}
        </div>
        <div class="col-md-9">
            {{ Form::textarea($name, $value, array_merge(['class' => $cek, 'id' => $name, 'rows' => '5'], $attributes)) }}
            <p class="invalid-feedback">{{ $errors->first($name) }}</p>
        </div>
        @else
            <div class="col-md-12">
                {{ Form::textarea($name, $value, array_merge(['class' => $cek, 'id' => $name, 'rows' => '5'], $attributes)) }}
                <p class="invalid-feedback">{{ $errors->first($name) }}</p>
            </div>
        @endif
    </div>
</div>