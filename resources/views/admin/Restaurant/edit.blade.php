@extends('layouts.admin')

@section('content')
  <div class="container my-5 bg-body-secondary p-5 rounded-5 d-flex">
    <form action="{{ route('admin.restaurant.update', $restaurant->id) }}" class="row align-items-center needs-validation"
      method="POST" enctype="multipart/form-data" novalidate>
      @csrf
      @method('PUT')
      <div class="col-md-6 justify-content-center">
        <label for="inputName" class="form-label">Nome del Ristorante</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name"
          value="{{ old('name', $restaurant->name) }}" required>
        <div class="invalid-feedback">
          Il nome del ristorante è obbligatorio.
        </div>
        @error('name')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-12">
        <label for="inputDescription" class="form-label">Descrizione</label>
        <textarea class="form-control" id="inputDescription" name="description">{{ old('description', $restaurant->description) }}</textarea>
        <div class="invalid-feedback">
          La descrizione deve essere una stringa.
        </div>
        @error('description')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="inputAddress" class="form-label">Indirizzo</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address"
          value="{{ old('address', $restaurant->address) }}" required>
        <div class="invalid-feedback">
          L'indirizzo è obbligatorio.
        </div>
        @error('address')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="inputVatNumber" class="form-label">Partita IVA</label>
        <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="inputVatNumber"
          name="vat_number" value="{{ old('vat_number', $restaurant->vat_number) }}" required>
        <div class="invalid-feedback">
          La partita IVA è obbligatoria.
        </div>
        @error('vat_number')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3 col-12">
        <div class="mb-3  rounded p-2">
          <label for="image" class="form-label">Immagine</label>
          <input name="image" type="file" class="form-control" id="image" aria-describedby="imageHelp"
            onchange="showImage(event)" value="{{ old('image', $restaurant->image) }}">
          @if ($restaurant->image)
            <img class="thumb mt-3" id="thumb" src="{{ asset('storage/' . $restaurant->image) }}"
              alt="Immagine del ristorante">
            <p>{{ $restaurant->image_original_name }}</p>
          @else
            <img class="thumb mt-3" id="thumb" src="/img/no-image.jpg" alt="Immagine non disponibile">
          @endif
          @error('image')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-10 d-flex flex-column mt-3 mb-3">
          <label>Tipologia Ristorante:</label>
          <div>
            @foreach ($types as $type)
              <input class="btn-check" type="checkbox" name="types[]" autocomplete="off" id="type{{ $type->id }}"
                value="{{ $type->id }}" @if (in_array($type->id, old('types', $restaurant->types->pluck('id')->toArray()))) checked @endif>
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
        <div class="col-12 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Salva</button>
        </div>
    </form>
  </div>

  <!-- Script per la validazione di Bootstrap -->
  <script>
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
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

    function showImage(event) {
      const thumb = document.getElementById('thumb');
      thumb.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
@endsection
