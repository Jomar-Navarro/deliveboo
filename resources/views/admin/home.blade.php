@extends('layouts.admin')

@section('content')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .chart-container {
      position: relative;
      height: 350px;
      width: 100%;
      /* Larghezza completa */
    }
  </style>
  <div class="container-fluid overflow-auto bg-body-tertiary text-center m-0">
    <div class="row">
      <div class="col-lg-6 px-3 pt-3">
        <div class="card">
          <h3>Piatti popolari</h3>
          @if (!empty($dishNames) && !empty($dishQuantities))
            <div class="chart-container">
              <canvas id="popularDishesChart"></canvas>
            </div>
          @else
            <p>Manca un numero sufficiente di dati per visualizzare il grafico dei piatti popolari.</p>
          @endif
        </div>
      </div>
      <div class="col-lg-6 px-3 pt-3">
        <div class="card">
          <h3>Ordini al mese</h3>
          @if (!empty($months) && !empty($chartData))
            <div class="chart-container">
              <canvas id="ordersChart"></canvas>
            </div>
          @else
            <p>Manca un numero sufficiente di dati per visualizzare il grafico degli ordini al mese.</p>
          @endif
        </div>
      </div>
      <div class="col-12 px-3 pt-3">
        <div class="card">
          <h3>Guadagno mensile</h3>
          @if (!empty($revenueMonths) && !empty($revenueData))
            <div class="chart-container">
              <canvas id="revenueChart"></canvas>
            </div>
          @else
            <p>Manca un numero sufficiente di dati per visualizzare il grafico del guadagno mensile.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <script>
    // Controlla che i dati siano presenti prima di inizializzare i grafici
    @if (isset($months) && !empty($months))
      var months = {!! json_encode($months) !!};
    @else
      var months = [];
    @endif

    @if (isset($chartData) && !empty($chartData))
      var chartData = {!! json_encode($chartData) !!};
    @else
      var chartData = [];
    @endif

    @if (isset($dishNames) && !empty($dishNames))
      var dishNames = {!! json_encode($dishNames) !!};
    @else
      var dishNames = [];
    @endif

    @if (isset($dishQuantities) && !empty($dishQuantities))
      var dishQuantities = {!! json_encode($dishQuantities) !!};
    @else
      var dishQuantities = [];
    @endif

    @if (isset($revenueMonths) && !empty($revenueMonths))
      var revenueMonths = {!! json_encode($revenueMonths) !!};
    @else
      var revenueMonths = [];
    @endif

    @if (isset($revenueData) && !empty($revenueData))
      var revenueData = {!! json_encode($revenueData) !!};
    @else
      var revenueData = [];
    @endif

    // Inizializzazione del grafico per gli ordini al mese
    var ctxOrders = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctxOrders, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: 'Ordini al mese',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          data: chartData,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          xAxes: [{
            type: 'time',
            time: {
              unit: 'month',
              tooltipFormat: 'MMM YYYY',
              displayFormats: {
                month: 'MMM YYYY'
              }
            },
            scaleLabel: {
              display: true,
              labelString: 'Month'
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 1
            },
            scaleLabel: {
              display: true,
              labelString: 'Number of Orders'
            }
          }]
        },
        plugins: {
          zoom: {
            pan: {
              enabled: true,
              mode: 'x',
            },
            zoom: {
              enabled: true,
              mode: 'x',
            }
          }
        }
      }
    });

    // Inizializzazione del grafico per i piatti popolari
    var ctxDishes = document.getElementById('popularDishesChart').getContext('2d');
    var popularDishesChart = new Chart(ctxDishes, {
      type: 'pie',
      data: {
        labels: dishNames,
        datasets: [{
          label: 'Totale ordini',
          backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
          ],
          data: dishQuantities,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: 'right',
        },
        title: {
          display: true,
          text: 'Popular Dishes'
        },
        animation: {
          animateScale: true,
          animateRotate: true
        }
      }
    });

    // Inizializzazione del grafico per il guadagno mensile
    var ctxRevenue = document.getElementById('revenueChart').getContext('2d'); // Id corretto per il terzo grafico
    var revenueChart = new Chart(ctxRevenue, {
      type: 'line',
      data: {
        labels: revenueMonths,
        datasets: [{
          label: 'Guadagno mensile',
          data: revenueData,
          borderColor: 'rgba(255, 99, 132, 1)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          fill: false
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          xAxes: [{
            type: 'time',
            time: {
              unit: 'month',
              tooltipFormat: 'MMM YYYY',
              displayFormats: {
                month: 'MMM YYYY'
              }
            },
            scaleLabel: {
              display: true,
              labelString: 'Month'
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            },
            scaleLabel: {
              display: true,
              labelString: 'Revenue'
            }
          }]
        }
      }
    });
  </script>
@endsection
