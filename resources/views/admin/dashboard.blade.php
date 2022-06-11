@extends('layouts.admin')
@section('content')
    <div class="row d-flex justify-content-md-between">
        <div class="col text-center mb-3">
            <h4>{{ __('home.analytics_dash') }}</h4>

        </div>
    </div>
    <div class="row text-center">

        <div class="col-md-5" id="events" style="height: 300px;">
            <strong class="text-center text-primary">@lang('home.events_nav')</strong>
        </div>
        <div class="col-md-7" id="users" style="height: 300px;">
            <strong class="text-center text-primary">@lang('home.users')</strong>
        </div>
        <div class="col-md-4" id="news" style="height: 300px;">
            <strong class="text-center text-primary">@lang('home.users')</strong>
        </div>
        <div class="chart-container">
            <div class="pie-chart-container">
              <canvas id="myChart"></canvas>
            </div>
          </div>
    </div>




    <script src="{{ asset('js/echarts.min.js') }}"></script>
    <script src="{{ asset('js/chartisan_echarts.js') }}"></script>
    <script src="{{ asset('js/echarts-en.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
   
    <script>
        const chart1 = new Chartisan({
            el: '#events',
            url: "@chart('events_chart')",
            hooks: new ChartisanHooks().colors().datasets(['bar'])
        });
        const chart2 = new Chartisan({
            el: '#users',
            url: "@chart('users_chart')",
            hooks: new ChartisanHooks().colors().datasets(['bar'])
        });
        const chart3 = new Chartisan({
            el: '#news',
            url: "@chart('news_chart')",
            hooks: new ChartisanHooks().colors().datasets(['bar'])
        });
    </script>
    <script>
       const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
      </script>
@endsection