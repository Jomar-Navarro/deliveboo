@extends('layouts.admin')

@section('content')

    <div class="container text-center mt-5">
        <h1>My Restaurant</h1>

        @foreach ($restaurant as $item)
        <div>
            <h1>{{ $item->name }}</h1>
            <img src="{{ $item->image }}" alt="">
        </div>
        @endforeach
    </div>

@endsection
