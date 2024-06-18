@extends('layouts.admin')

@section('content')
    <div class="container mt-2">
        <h1>Il Mio Ristorante</h1>
        <div class="row d-flex align-items-center mt-5">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-4">
                <h1>{{ $restaurant->name }}</h1>

                <div>
                    @foreach ($types as $type)
                        <span class="badge text-bg-success mb-3">{{ $type->type_name }}</span>
                    @endforeach
                </div>

                {{-- <img class="w-100 rest-img" src="{{ $restaurant->image }}" alt=""> --}}
                <img class="img-fluid w-50" src="{{ asset('storage/' . $restaurant->image) }}" alt=""
                    onerror="this.src='/img/no-image.jpg'">
            </div>


        </div>
    </div>
@endsection
