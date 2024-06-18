@extends('layouts.admin')

@section('content')
    <div class="container my-5 bg-body-secondary p-5 rounded-5 d-flex">
        <form action="{{ route('admin.dish.store') }}" class="row align-items-center needs-validation" method="POST"
            enctype="multipart/form-data" novalidate>
            @csrf
            <div class="col-md-6 justify-content-center">
                <label for="inputDishName" class="form-label">Nome del Piatto</label>
                <input type="text" class="form-control @error('dish_name') is-invalid @enderror" id="inputDishName"
                    name="dish_name" value="{{ old('dish_name') }}" required>
                <div class="invalid-feedback">
                    Il nome del piatto è obbligatorio.
                </div>
            </div>
            <div class="col-12">
                <label for="inputDescription" class="form-label">Descrizione</label>
                <textarea class="form-control" id="inputDescription" name="description">{{ old('description') }}</textarea>
                <div class="invalid-feedback">
                    La descrizione è obbligatoria.
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputPrice" class="form-label">Prezzo</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="inputPrice"
                    name="price" value="{{ old('price') }}" required>
                <div class="invalid-feedback">
                    Il prezzo è obbligatorio.
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputIsVisible" class="form-label">Visibile</label>
                <select id="inputIsVisible" class="form-select" name="is_visible" required>
                    <option value="1" {{ old('is_visible') == '1' ? 'selected' : '' }}>Sì</option>
                    <option value="0" {{ old('is_visible') == '0' ? 'selected' : '' }}>No</option>
                </select>
                <div class="invalid-feedback">
                    La visibilità è obbligatoria.
                </div>
            </div>



            <div class="mb-3 col-12">
                <label for="formFile" class="form-label">Carica Immagine</label>
                <input class="form-control" type="file" id="formFile" name="image_url">
                @error('image_url')
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
        // Esempio di JavaScript per disabilitare l'invio dei form se ci sono campi non validi
        (() => {
            'use strict'

            // Seleziona tutti i form a cui vogliamo applicare le classi di validazione personalizzate di Bootstrap
            const forms = document.querySelectorAll('.needs-validation')

            // Itera su di essi e impedisce l'invio
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
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
