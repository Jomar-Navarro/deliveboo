@extends('layouts.admin')
@section('content')
  <div class="container">
    <h1>Tipologie Ristoranti</h1>
    <div>
      <h5>Aggiungi una tipologia</h5>
      <form class="d-flex" action="{{ route('admin.type.store') }}" method="POST">
        @csrf

        <div>
          <input type="text" class="form-control w-75 @error('type') is-invalid @enderror" placeholder="Nuova Tipologia"
            name="type" value="{{ old('type') }}">
          @error('type')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div>
            <textarea name="description" cols="30" rows="1" placeholder="Aggiungi Descrizione"></textarea>
        </div>
        <button class="btn btn-success ms-2" type="submit">Conferma</button>
      </form>
    </div>
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif
    <table class="table w-75">
      <thead>
        <tr class="fs-5">
          <th scope="col">Nome</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($types as $type)
          <tr>
            <form action="{{ route('admin.type.update', $type) }}" method="POST" id="form-edit-{{ $type->id }}">
              @csrf
              @method('PUT')
              <td>
                <input class="w-100 input_type" value="{{ $type->type_name }}" name="name">
              </td>
              <td>
                <textarea class="input_type" cols="30" rows="1" name="description">{{ $type->description }}</textarea>
              </td>
              <td>
                <div class="d-flex">
                  {{-- EDIT --}}
                  <button type="button" class="btn btn-warning me-2" onclick="submitForm({{ $type->id }})"><i
                      class="fa-solid fa-pencil"></i></button>
                </div>
              </td>
            </form>
            <td>
              {{-- DELETE --}}
              <form class="mb-0" action="{{ route('admin.type.destroy', $type) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
<script>
  function submitForm(id) {
    const form = document.getElementById(`form-edit-${id}`);
    form.submit();
  }
</script>
