<!-- resources/views/orders/show.blade.php -->

@extends('layouts.admin')

@section('content')
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>Ordine di {{ $order->name }} {{ $order->lastname }}</h2>
      </div>
      <div class="card-body">
        <p><strong>Indirizzo:</strong> {{ $order->address }}</p>
        <p><strong>CAP:</strong> {{ $order->postal_code }}</p>
        <p><strong>Telefono:</strong> {{ $order->phone_number }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Totale:</strong> €{{ number_format($order->total_price, 2, ',', '.') }}</p>
        <p><strong>Creazione:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
        <h3>Piatti Ordinati</h3>
        @if ($order->dishes->isEmpty())
          <p>Non ci sono piatti ordinati.</p>
        @else
          <ul>
            @foreach ($order->dishes as $dish)
              <li>{{ $dish->dish_name }} (Quantità: {{ $dish->pivot->quantity }})</li>
            @endforeach
          </ul>
        @endif
      </div>
      <div class="card-footer">
        <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Torna alla Lista degli Ordini</a>
      </div>
    </div>
  </div>
@endsection
