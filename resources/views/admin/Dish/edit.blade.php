@extends('layouts.admin')

@section('content')
  <div class="container my-5 bg-body-secondary p-5 rounded-5 d-flex">
    <form action="{{ route('admin.dish.update', $dish->id) }}" class="row g-3 needs-validation" method="POST"
      enctype="multipart/form-data" novalidate>
      @csrf
      @method('PUT')
      <div class="col-md-6">
        <label for="inputDishName" class="form-label">Nome del Piatto</label>
        <input type="text" class="form-control @error('dish_name') is-invalid @enderror" id="inputDishName"
          name="dish_name" value="{{ old('dish_name', $dish->dish_name) }}" required>
        <div class="invalid-feedback">
          Il nome del piatto è obbligatorio.
        </div>
      </div>
      <div class="col-md-6">
        <label for="inputPrice" class="form-label">Prezzo</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" id="inputPrice" name="price"
          value="{{ old('price', $dish->price) }}" required>
        <div class="invalid-feedback">
          Il prezzo è obbligatorio.
        </div>
      </div>
      <div class="col-12">
        <label for="inputDescription" class="form-label">Descrizione</label>
        <textarea class="form-control" id="inputDescription" name="description">{{ old('description', $dish->description) }}</textarea>
        <div class="invalid-feedback">
          La descrizione è obbligatoria.
        </div>
      </div>
      <div class="col-md-6">
        <label for="inputIsVisible" class="form-label">Visibile</label>
        <select id="inputIsVisible" class="form-select" name="is_visible" required>
          <option value="1" {{ old('is_visible', $dish->is_visible) == 1 ? 'selected' : '' }}>Sì</option>
          <option value="0" {{ old('is_visible', $dish->is_visible) == 0 ? 'selected' : '' }}>No</option>
        </select>
        <div class="invalid-feedback">
          La visibilità è obbligatoria.
        </div>
      </div>

      {{-- <div class="mb-3 col-12">
        <label for="formFile" class="form-label">Carica Immagine</label>
        <input class="form-control" type="file" id="formFile" name="image_url">
        @error('image_url')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div> --}}

      <div class="mb-3 bg-body-tertiary rounded p-2">
        <label for="image" class="form-label">Carica Immagine</label>
        <input name="image_url" type="file" class="form-control" id="image" aria-describedby="imageHelp"
          onchange="showImage(event)">
        @if ($dish->image_url)
          <img class="thumb mt-3" id="thumb" src="{{ asset('storage/' . $dish->image_url) }}"
            alt="Immagine del piatto">
          <p>{{ $dish->image_original_name }}</p>
        @else
          <img class="thumb mt-3" id="thumb" src="/img/no-image.jpg" alt="Immagine non disponibile">
        @endif
        @error('image_url')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

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
