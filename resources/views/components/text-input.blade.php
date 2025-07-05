@php
    $classes = 'form-input';
    if ($errors->has($attributes->get('name'))) {
        $classes .= ' input-error';
    }
@endphp

<input {{ $attributes->merge(['class' => $classes]) }}>
