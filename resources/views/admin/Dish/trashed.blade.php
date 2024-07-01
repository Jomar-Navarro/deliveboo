@extends('layouts.admin')

@section('content')
  <div class="container mt-5 overflow-auto">
    <h1>Piatti eliminati</h1>
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($trashedDishes->isEmpty())
      <div class="alert alert-warning">
        Non ci sono piatti eliminati.
      </div>
    @else
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
            @foreach ($trashedDishes as $item)
              <tr>
                <td>{{ $item->dish_name }}</td>
                <td>
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
                    <form action="{{ route('admin.dish.restore', $item->id) }}" method="POST" class="mx-2">
                      @csrf
                      <button type="submit" class="btn btn-warning index-btn">Ripristina</button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
