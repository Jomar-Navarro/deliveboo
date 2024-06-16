@extends('layouts.admin')

@section('content')


  <div class="container my-5 bg-body-secondary p-5 d-flex rounded-5">
    <form action="{{ route('admin.restaurant.store') }}" class="row g-3 align-items-center" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="col-md-6">
        <label for="inputName" class="form-label">Nome</label>
        <input
          type="text"
          class="
          @error('name')
            is-invalid
          @enderror form-control"
          id="inputName"
          name="name"
          value="{{ old('name') }}"
          >
        @error('name')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-6">
        <label for="inputAddress" class="form-label">Indirizzo</label>
        <input
          type="text"
          class="
          @error('address')
            is-invalid
          @enderror
          form-control"
          id="inputAddress"
          name="address"
          value="{{ old('address') }}">
        @error('address')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-12">
        <label for="inputDescription" class="form-label">Descrizione</label>
        <textarea
          class="
          @error('description')
            is-invalid
          @enderror
          form-control"
          id="inputDescription"
          name="description">{{
          old('description')
          }}</textarea>
        @error('description')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-6">
        <label for="inputVatNumber" class="form-label">Numero di Partita IVA</label>
        <input
          type="text"
          class="
          @error('vat_number')
            is-invalid
          @enderror
          form-control"
          id="inputVatNumber"
          name="vat_number"
          value="{{ old('vat_number') }}">
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
        <input
          class="
           @error('image')
            is-invalid
          @enderror
          form-control"
          type="file"
          id="formFile"
          name="image">
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
