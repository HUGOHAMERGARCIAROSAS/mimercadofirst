@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} <a href="{{ url('/') }}">MiMercado.delivery</a>
            Todos los derechos reservados
            Desarrollado por <a href="http://www.pyrusstudio.com/web/" target="_blank">Pyrus Studio</a>
        @endcomponent
    @endslot
@endcomponent
