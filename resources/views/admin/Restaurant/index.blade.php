@extends('layouts.admin')

@section('content')
<div class="container mt-2">
    <h1>Il Mio Ristorante</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($restaurant)
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

                <img class="img-fluid w-50 rest-img" src="{{ asset('storage/' . $restaurant->image) }}" alt=""
                     onerror="this.src='{{ $restaurant->image }}'">
            </div>

            <div class="col-8">
                @if ($restaurant->trashed())
                    <form action="{{ route('admin.restaurant.restore', $restaurant->id) }}" method="POST" class="m-2">
                        @csrf
                        <button type="submit" class="btn btn-warning">Ripristina</button>
                    </form>
                @else
                    <form action="{{ route('admin.restaurant.destroy', $restaurant->id) }}" method="POST" class="m-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            Non hai ancora creato un ristorante. <a href="{{ route('admin.restaurant.create') }}">Crea ora</a>.
        </div>
    @endif
</div>
@endsection
