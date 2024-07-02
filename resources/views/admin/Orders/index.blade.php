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
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>

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
