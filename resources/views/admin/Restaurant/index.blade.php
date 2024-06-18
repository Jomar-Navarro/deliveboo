@extends('layouts.admin')

@section('content')
  <div class="container text-center mt-5">
    <h1>My Restaurant</h1>
    <div class="row">
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <div class="col-4">
        <h1>{{ $restaurant->name }}</h1>
        <a href="{{ route('admin.restaurant.edit', $restaurant) }}" class="btn btn-outline-warning m-2">
          <i class="fa-solid fa-pen-nib "></i></a>
        <img class="w-100 rest-img" src="{{ $restaurant->image }}" alt="">
      </div>

      @foreach ($types as $type)
        <span class="text-primary">{{ $type->type_name }}</span>
      @endforeach
    </div>
  </div>
@endsection
