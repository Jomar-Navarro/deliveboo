@extends('layouts.admin')

@section('content')
  <div class="container my-5 bg-body-secondary p-5 rounded-5 d-flex">
    <form action="{{ route('admin.dish.store') }}" class="row align-items-center" method="POST"
      enctype="multipart/form-data">
      @csrf
      <div class="col-md-6 justify-content-center">
        <label for="inputDishName" class="form-label">Nome del Piatto</label>
        <input type="text" class="form-control @error('dish_name')
          is-invalid
          @enderror"
          id="inputDishName" name="dish_name" value="{{ old('dish_name') }}">
        @error('dish_name')
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
        <label for="inputPrice" class="form-label">Prezzo</label>
        <input type="text" class="form-control @error('price')
          is-invalid
          @enderror"
          id="inputPrice" name="price" value="{{ old('price') }}">
        @error('price')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="inputIsVisible" class="form-label">Visibile</label>
        <select id="inputIsVisible" class="form-select" name="is_visible">
          <option value="1" {{ old('is_visible') == '1' ? 'selected' : '' }}>Sì</option>
          <option value="0" {{ old('is_visible') == '0' ? 'selected' : '' }}>No</option>
        </select>
        @error('is_visible')
          <div class="text-danger">{{ $message }}</div>
        @enderror
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
@endsection
