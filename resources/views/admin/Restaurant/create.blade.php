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

      <div class="col-md-6">
        <label for="inputState" class="form-label">Stato</label>
        <select id="inputState" class="form-select @error('state') is-invalid @enderror" name="state">
          <option value="" selected disabled>Scegli...</option>
          <option value="active" {{ old('state') == 'active' ? 'selected' : '' }}>Attivo</option>
          <option value="inactive" {{ old('state') == 'inactive' ? 'selected' : '' }}>Inattivo</option>
        </select>
        <div class="invalid-feedback">
          Seleziona lo stato del ristorante.
        </div>
        @error('state')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3 col-12">
        <label for="formFile" class="form-label">Carica Immagine</label>
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image">
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
  </script>
@endsection
