@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1 class="text-center my-5">{{ $dish->dish_name }}</h1>
    <div class="row">

      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
      <div class="col-8">

        @if ($dish->image_url)
          @php
            $isAbsoluteUrl = filter_var($dish->image_url, FILTER_VALIDATE_URL);
          @endphp

          @if ($isAbsoluteUrl)
            <img class="w-75 img-squ" src="{{ $dish->image_url }}" alt="">
          @else
            <img class="w-75 img-squ" src="{{ asset('storage/' . $dish->image_url) }}" alt="">
          @endif
          <p>{{ $dish->image_original_name }}</p>
        @endif
      </div>
      <div class="col-4">

        <p><strong>Descrizione:</strong> {{ $dish->description }}</p>
        <p><strong>Prezzo:</strong> {{ $dish->price }}</p>
        <p><strong>Visibile:</strong> {{ $dish->is_visible ? 'Sì' : 'No' }}</p>
        <a href="{{ route('admin.dish.index') }}" class="btn btn-primary mt-3">Torna all'indice</a>
      </div>



    </div>
  </div>

@endsection
