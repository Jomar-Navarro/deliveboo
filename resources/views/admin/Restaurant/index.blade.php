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
      @foreach ($restaurant as $item)
        <div class="col-4">
          <h1>{{ $item->name }}</h1>
          <a href="{{ route('admin.restaurant.edit', $item) }}" class="btn btn-outline-warning m-2">
            <i class="fa-solid fa-pen-nib "></i></a>
          <img class="w-100 rest-img" src="{{ $item->image }}" alt="">
        </div>
      @endforeach
    </div>
  </div>
@endsection
