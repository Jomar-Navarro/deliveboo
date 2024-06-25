@extends('layouts.admin')

@section('content')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <div class="container text-center mt-5">
    <h1>Home Dashboard</h1>

    <div class="row">
      <div class="col-md-6">
        <h3>Orders per Month</h3>
        <canvas id="ordersChart" width="400" height="400"></canvas>
      </div>
      <div class="col-md-6">
        <h3>Popular Dishes</h3>
        <canvas id="popularDishesChart" width="400" height="400"></canvas>
      </div>
    </div>
  </div>

  <script>
    var months = {!! json_encode($months) !!};
    var chartData = {!! json_encode($chartData) !!};
    var dishNames = {!! json_encode($dishNames) !!};
    var dishQuantities = {!! json_encode($dishQuantities) !!};

    // Grafico per gli ordini per mese
    var ctx1 = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctx1, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: 'Orders per Month',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          data: chartData,
        }]
      },
      options: {
        responsive: true,
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
        labels: dishNames, // Utilizza i nomi dei piatti come etichette
        datasets: [{
          label: 'Popular Dishes',
          backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
          ],
          data: dishQuantities, // Utilizza le quantità vendute come dati
        }]
      },
      options: {
        responsive: true,
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
