@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo Indirizzo Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Un nuovo link di verifica è stato inviato al tuo indirizzo email.') }}
                    </div>
                    @endif

                    {{ __('Prima di procedere, controlla la tua email per un link di verifica.') }}
                    {{ __('Se non hai ricevuto l\'email') }},
                    <form class="d-inline needs-validation" method="POST" action="{{ route('verification.resend') }}" novalidate>
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clicca qui per richiederne un altro') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Disabilitare l'invio del form se ci sono campi non validi
    (function () {
        'use strict'

        // Prendere tutti i form a cui vogliamo applicare stili di validazione di Bootstrap personalizzati
        var forms = document.querySelectorAll('.needs-validation')

        // Loop su di essi e prevenire l'invio
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection
