{{-- <a href="{{ Route('index')}}">
  <img
    src="{{url('/frontend/images/content/logo-promad.png') }}"
    alt="Luxspace | Fulfill your house with beautiful furniture"/>
</a> --}}

@php
    $route = route('index');
    if (Auth::check()) {
        $route = Auth::user()->roles === 'ADMIN' ? route('dashboard.index') : route('index');
    }
@endphp

<a href="{{ $route }}">
    <img
        src="{{ url('/frontend/images/content/logo-promad.png') }}"
        alt="Promad Logo"
    />
</a>
