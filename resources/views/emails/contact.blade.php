@component('mail::message')
# CONTACTO

@component('mail::panel')
    Tipo de consulta: {{ $request->request_type }} <br>
    Nombres y Apellidos: {{ $request->name }} <br>
    N° de documento: {{ $request->documento }} <br>
    E-mail: {{ $request->email }} <br>
    Telefono: {{ $request->phone }} <br>
    Comentario: {{ $request->comment }}
@endcomponent

@component('mail::subcopy')
    <div style="text-align: center">
        <img src="{{ asset('assets/images/LOGO_SEGURIDAD.png') }}">
    </div>
@endcomponent

@endcomponent

