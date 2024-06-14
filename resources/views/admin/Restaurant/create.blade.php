@extends('layouts.admin')

@section('content')
  <div class="container">
    <form action="{{ route('admin.restaurant.store') }}" class="row g-3" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="col-md-6">
        <label for="inputName" class="form-label">Nome</label>
        <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}">
        @error('name')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="inputAddress" class="form-label">Indirizzo</label>
        <input type="text" class="form-control" id="inputAddress" name="address" value="{{ old('address') }}">
        @error('address')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-12">
        <label for="inputDescription" class="form-label">Descrizione</label>
        <textarea class="form-control" id="inputDescription" name="description">{{ old('description') }}</textarea>
        @error('description')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="inputVatNumber" class="form-label">Numero di Partita IVA</label>
        <input type="text" class="form-control" id="inputVatNumber" name="vat_number" value="{{ old('vat_number') }}">
        @error('vat_number')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="inputState" class="form-label">Stato</label>
        <select id="inputState" class="form-select" name="state">
          <option selected>Scegli...</option>
          <option>...</option>
        </select>
        @error('state')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3 col-12">
        <label for="formFile" class="form-label">Carica Immagine</label>
        <input class="form-control" type="file" id="formFile" name="image">
        @error('image')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary">Salva</button>
      </div>
    </form>
  </div>
@endsection
