@extends('layouts.admin')

@section('content')
    <div class="container my-5 bg-body-secondary p-5 d-flex rounded-5">
        <form action="{{ route('admin.restaurant.store') }}" class="row g-3 align-items-center needs-validation" method="POST"
            enctype="multipart/form-data" novalidate>
            @csrf
            <div class="col-md-6">
                <label for="inputName" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name"
                    value="{{ old('name') }}" required>
                <div class="invalid-feedback">
                    Il nome è obbligatorio.
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Indirizzo</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress"
                    name="address" value="{{ old('address') }}" required>
                <div class="invalid-feedback">
                    L'indirizzo è obbligatorio.
                </div>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="inputDescription" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="inputDescription" name="description">{{ old('description') }}</textarea>
                <div class="invalid-feedback">
                    La descrizione è obbligatoria.
                </div>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="inputVatNumber" class="form-label">Numero di Partita IVA</label>
                <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="inputVatNumber"
                    name="vat_number" value="{{ old('vat_number') }}" required>
                <div class="invalid-feedback">
                    Il numero di Partita IVA non è valido.
                </div>
                @error('vat_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="type" class="form-label">Tipologie Ristorante: </label>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($types as $type)
                        <input name="types[]" type="checkbox" class="btn-check" id="type_{{ $type->id }}"
                            autocomplete="off" value="{{ $type->id }} @error('types[]') is-invalid @enderror"
                            @if (($errors->any() && in_array($type->id, old('types', []))) || (!$errors->any() && $restaurant?->types->contains($type))) checked @endif>
                        <label class="btn btn-outline-primary" for="type_{{ $type->id }}">
                            {{ $type->name }}
                        </label>
                    @endforeach

                    @error('types[]')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror
                </div> --}}


            <div class="col-6 d-flex flex-column mt-3 mb-5">
                <label>Tipologia Ristorante:</label>
                <div>
                    @foreach ($types as $type)
                        <input class="btn-check" type="checkbox" name="types[]" autocomplete="off"
                            id="type{{ $type->id }}" value="{{ $type->id }}"
                            @if (in_array($type->id, old('types', []))) checked @endif>
                        <label class="btn btn-outline-primary rounded-5 me-2 mt-3 py-1"
                            for="type{{ $type->id }}">{{ $type->type_name }}</label>
                    @endforeach


                    @error('types[]')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            {{-- <select name="type_id" class="rounded-2 my-3 border-primary px-2 w-100" aria-label="Default select example">
                @foreach ($types as $item)
                    <option @if (old('type_id', $item->restaurant?->id) == $item->id) selected @endif value="{{ $item->id }}">
                        {{ $item->type_name }}
                    </option>
                @endforeach

            </select> --}}

            <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="image" class="form-label">Image</label>
                <input name="image" type="file" class="form-control" id="image" aria-describedby="emailHelp"
                    onchange="showImage(event)">
                <img class="thumb" id="thumb" src="/img/no-image.jpg" alt="">
            </div>
            <div class="invalid-feedback">
                Carica un'immagine valida.
            </div>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Salva</button>
    </div>
    </form>
    </div>

    <!-- Script per la validazione di Bootstrap -->
    <script>
        (() => {
            'use strict';

            // Seleziona tutti i form a cui applicare le classi di validazione personalizzate di Bootstrap
            const forms = document.querySelectorAll('.needs-validation');

            // Impedisce l'invio del form se ci sono campi non validi
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();

        function showImage(event) {
            // console.log(URL.createObjectURL(event.target.files[0]);
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
