@extends('layouts.admin')

@section('content')
  <div class="container pt-5">
    <h1 class=" text-center">Tipologie Ristoranti</h1>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <table class="table w-100">
      <thead>
        <tr class="fs-5">
          <th scope="col">Nome</th>
          <th scope="col">Descrizione</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($types as $type)
          <tr>
            <td>{{ $type->type_name }}</td>
            <td>{{ $type->description }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
