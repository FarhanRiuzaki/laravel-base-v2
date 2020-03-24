<div class="form-group">
    @php
        $cek = 'form-control select2' . $class;
        if($errors->has($name)){
            $cek = 'form-control select2' . $class . \isValid($errors->has($name)) ;
        }
    @endphp
    <div class="row">
        @if ($label)
            <div class="col-md-3">
                {{ Form::label($label, null, ['class' => 'control-label']) }}
            </div>
            <div class="col-md-9">
                {!! Form::select($name,$value,$default,array_merge(['class'=>$cek,'id'=>$name],$attributes)); !!}
                <p class="invalid-feedback">{{ $errors->first($name) }}</p>
            </div>
        @else
            <div class="col-md-12">
                {!! Form::select($name,$value,$default,array_merge(['class'=>$cek,'id'=>$name],$attributes)); !!}
                <p class="invalid-feedback">{{ $errors->first($name) }}</p>
            </div>
        @endif
    </div>
</div>