@extends('layouts.admin')

@section('content')
<div class="container mt-2">
    <h1>Ristoranti Eliminati</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($trashedRestaurants->isEmpty())
        <div class="alert alert-warning">
            Non ci sono ristoranti eliminati.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Indirizzo</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashedRestaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->address }}</td>
                        <td>
                            <form action="{{ route('admin.restaurant.restore', $restaurant->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">Ripristina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
