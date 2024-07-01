@extends('layouts.admin')

@section('content')
  <div class="container mt-5 overflow-auto">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div>
      <table class="table m-0">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Immagine</th>
            <th scope="col">Prezzo</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Visibilità</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dishes as $item)
            <tr>
              <td>{{ $item->dish_name }}</td>
              <td>
                {{-- Immagine del piatto --}}
                @php
                  $isAbsoluteUrl = filter_var($item->image_url, FILTER_VALIDATE_URL);
                @endphp

                @if ($isAbsoluteUrl)
                  <img class="thumb" src="{{ $item->image_url }}" alt="">
                @else
                  <img class="thumb" src="{{ asset('storage/' . $item->image_url) }}" alt="">
                @endif
              </td>
              <td>{{ $item->price }}</td>
              <td>{{ $item->description }}</td>
              <td>{{ $item->is_visible ? 'Sì' : 'No' }}</td>
              <td>
                <div class="d-flex">
                  {{-- Visualizza dettagli --}}
                  <a href="{{ route('admin.dish.show', $item) }}" class="btn btn-outline-success m-2">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  {{-- Modifica --}}
                  <a href="{{ route('admin.dish.edit', $item) }}" class="btn btn-outline-warning m-2">
                    <i class="fa-solid fa-pen-nib"></i>
                  </a>
                  {{-- Eliminazione --}}
                  @if ($item->trashed())
                    {{-- Ripristina --}}
                    <form action="{{ route('admin.dish.restore', $item->id) }}" method="POST" class="m-2">
                      @csrf
                      <button type="submit" class="btn btn-warning">Ripristina</button>
                    </form>
                  @else
                    {{-- Elimina con conferma --}}
                    <form action="{{ route('admin.dish.destroy', $item->id) }}" method="POST" class="m-2"
                      onsubmit="return confirm('Sei sicuro di voler eliminare questo piatto?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" title="Elimina">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  @endif
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
