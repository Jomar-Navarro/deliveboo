@extends('layouts.admin')

@section('content')
  <div class="container mt-5 overflow-auto">
    <h1>My dish</h1>
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div>

      <table class="table m-0">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Prezzo</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Visibilità</th>
            <th scope="col">Funzioni</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dishes as $item)
            <tr>
              <th scope="row">{{ $item->id }}</th>
              <td>{{ $item->dish_name }}</td>
              <td>&euro; {{ $item->price }}</td>
              <td>{{ $item->description }}</td>
              <td>{{ $item->is_visible }}</td>
              <td>
                <div class="d-flex">

                  <a href="{{ route('admin.dish.edit', $item) }}" class="btn btn-outline-warning index-btn mx-2">
                    <i class="fa-solid fa-pen-nib "></i></a>
                  <a href="{{ route('admin.dish.show', $item) }}" class="btn btn-outline-warning index-btn mx-2">
                    <i class="fa-solid fa-eye "></i></a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
@endsection
