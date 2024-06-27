@extends('layouts.admin')

@section('content')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .chart-container {
      position: relative;
      height: 400px;
    }
  </style>
  <div class="container text-center m-0">
    <div class="row">
      <div class="col-12 col-md-6 px-3 pt-3">
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
      <div class="col-12 col-md-6 px-3 pt-3">
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
    </div>
  </div>

  <script>
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

    // Grafico per gli ordini per mese
    var ctx1 = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctx1, {
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

    // Grafico per i piatti più ordinati (tipo pie)
    var ctx2 = document.getElementById('popularDishesChart').getContext('2d');
    var popularDishesChart = new Chart(ctx2, {
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
  </script>
@endsection
