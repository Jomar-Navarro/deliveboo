@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>{{ $dish->dish_name }}</h1>
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <p><strong>Descrizione:</strong> {{ $dish->description }}</p>
        <p><strong>Prezzo:</strong> €{{ $dish->price }}</p>
        <p><strong>Visibile:</strong> {{ $dish->is_visible ? 'Sì' : 'No' }}</p>
        @if ($dish->image_url)
          <p><strong>Immagine:</strong></p>
          <img src="{{ $dish->image_url }}" alt="" class="img-thumbnail" style="max-width: 200px;">
        @endif
        <a href="{{ route('admin.dish.index') }}" class="btn btn-primary mt-3">Torna all'indice</a>
      </div>
    </div>
  </div>
@endsection
