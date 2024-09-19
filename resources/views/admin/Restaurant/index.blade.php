@extends('layouts.admin')

@section('content')
  <div class="container mt-2">
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    @if ($restaurant)
      <div class="row d-flex mt-5">
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="d-flex">
          <h1>{{ $restaurant->name }}</h1>
          @if ($restaurant->trashed())
            {{-- Ripristina il ristorante --}}
            <form action="{{ route('admin.restaurant.restore', $restaurant->id) }}" method="POST" class="m-2">
              @csrf
              <button type="submit" class="btn btn-warning">Ripristina</button>
            </form>
          @else
            {{-- Elimina il ristorante con conferma --}}
            <form action="{{ route('admin.restaurant.destroy', $restaurant->id) }}" method="POST" class="m-2"
              onsubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" title="Elimina">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          @endif
        </div>
        <div class="col-6">
          {{-- Immagine del ristorante --}}
          <div class="img-container">
              <img class="img-fluid rest-img" src="{{ asset('storage/' . $restaurant->image) }}" alt=""
                onerror="this.src='{{ $restaurant->image }}'">
          </div>
        </div>
        <div class="col-6">
          <div>
            {{-- Tipologie del ristorante --}}
            @foreach ($types as $type)
              <span class="badge text-bg-success mb-3">{{ $type->type_name }}</span>
            @endforeach
          </div>
          {{-- Descrizione del ristorante --}}
          <p>{{ $restaurant->description }}</p>
        </div>
      </div>
    @else
      {{-- Messaggio se non ci sono ristoranti --}}
      <div class="alert alert-warning">
        Non hai ancora creato un ristorante. <a href="{{ route('admin.restaurant.create') }}">Crea ora</a>.
      </div>
    @endif
  </div>
@endsection
