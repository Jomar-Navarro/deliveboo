<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            return view('admin.home')->with('warning', 'Nessun ristorante trovato. Assicurati di aver creato un ristorante.');
        }

        // Recupera tutti gli ordini relativi ai piatti del ristorante
        $orders = $restaurant->dishes()->with('orders')->get()->pluck('orders')->flatten();

        // Raggruppa gli ordini per mese e conta quelli per ogni mese
        $ordersByMonth = $orders->groupBy(function ($order) {
            return $order->created_at->format('Y-m'); // Raggruppa per anno e mese (YYYY-MM)
        })->map->count();

        // Ordina i mesi cronologicamente
        $orderedMonths = $ordersByMonth->keys()->sort();

        // Estrae i mesi e i totali degli ordini ordinati
        $months = $orderedMonths->values()->toArray(); // Converte le chiavi ordinate in un array PHP

        // Converte i totali degli ordini ordinati in un array PHP
        $chartData = $orderedMonths->map(function ($month) use ($ordersByMonth) {
            return $ordersByMonth[$month];
        })->values()->toArray();

        // Recupera i piatti del ristorante
        $dishes = $restaurant->dishes;

        // Array per mantenere il conteggio delle quantità dei piatti
        $popularDishesData = [];

        // Calcola le quantità totali di ciascun piatto
        foreach ($dishes as $dish) {
            $totalQuantity = $dish->orders()->sum('quantity'); // Supponendo che ci sia un campo 'quantity' nella tabella pivot

            $popularDishesData[] = [
                'name' => $dish->dish_name,
                'quantity' => $totalQuantity,
            ];
        }

        // Ordina per quantità decrescente
        usort($popularDishesData, function ($a, $b) {
            return $b['quantity'] - $a['quantity'];
        });

        // Prendi solo i primi 5 piatti più ordinati
        $popularDishesData = array_slice($popularDishesData, 0, 5);

        // Estrai nomi e quantità per il grafico dei piatti più ordinati
        $dishNames = array_column($popularDishesData, 'name');
        $dishQuantities = array_column($popularDishesData, 'quantity');

        // Passa i dati alla vista
        return view('admin.home', compact('chartData', 'months', 'dishNames', 'dishQuantities'));
    }
}
