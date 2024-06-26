@extends('layouts.admin')

@section('content')
  <div class="container mt-5 overflow-auto">
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
              <th>Creazione</th>
              <th>Consegnato</th> {{-- Nuova colonna per lo stato di consegna --}}
              <th>Azioni</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->lastname }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->postal_code }}</td>
                <td class="pho-number-w">{{ $order->phone_number }}</td>
                <td>{{ $order->email }}</td>
                <td>€{{ number_format($order->total_price, 2, ',', '.') }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                <td>
                  {{-- Checkbox per lo stato di consegna --}}
                  <div class="form-check d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" id="delivered{{ $order->id }}"
                      name="delivered{{ $order->id }}" {{ $order->delivered ? 'checked' : '' }}>
                    <label class="form-check-label" for="delivered{{ $order->id }}">

                    </label>
                  </div>
                </td>
                <td>
                  <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-info">Dettagli</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
<style>
  .pho-number-w {
    width: 12%;
  }
</style>
