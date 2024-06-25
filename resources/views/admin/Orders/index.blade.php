@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1>Lista degli Ordini</h1>

    @if ($orders->isEmpty())
      <p>Non ci sono ordini.</p>
    @else
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>

              <th>Nome</th>
              <th>Cognome</th>
              <th>Indirizzo</th>
              <th>CAP</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Totale</th>
              <th>Data di Creazione</th>
              <!-- Aggiungi qui gli altri campi specifici del tuo model Order -->
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>

                <td>{{ $order->name }}</td>
                <td>{{ $order->lastname }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->postal_code }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->email }}</td>
                <td>€{{ number_format($order->total_price, 2, ',', '.') }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                <!-- Aggiungi qui gli altri campi specifici del tuo model Order -->
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
