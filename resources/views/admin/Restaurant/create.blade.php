@extends('layouts.admin')

@section('content')
  <div class="container my-3 bg-body-secondary p-3 rounded-5">
    <form action="{{ route('admin.restaurant.store') }}" class="row g-3 needs-validation" method="POST"
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
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address"
          value="{{ old('address') }}" required>
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
      <div class="col-6 d-flex flex-column mt-3">
        <label>Tipologia Ristorante:</label>
        <div>
          @foreach ($types as $type)
            <input class="btn-check" type="checkbox" name="types[]" autocomplete="off" id="type{{ $type->id }}"
              value="{{ $type->id }}" @if (in_array($type->id, old('types', []))) checked @endif>
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

      <div class="col-md-11 mb-3">
        <label for="image" class="form-label">Immagine</label>
        <input name="image" type="file" class="form-control" id="image" aria-describedby="emailHelp"
          onchange="showImage(event)">
        <div class="invalid-feedback">
          Carica un'immagine valida.
        </div>
        @error('image')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <img class="thumb mt-2" id="thumb" src="/img/no-image.jpg" alt="">
      </div>

      <div class="col-1 align-self-end">
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
      const thumb = document.getElementById('thumb');
      thumb.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
@endsection
