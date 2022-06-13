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
            <strong class="text-center text-primary">@lang('home.news')</strong>
        </div>
        
          <div id="container" class="col-md-6" style="height:400px;"></div>
          <hr>
          <div id="helpmes" style="width:100%; height:400px;"></div>
          
    </div>
@php $pending = \App\Models\Helpme::where('status','Pending')->count();
$accepted = \App\Models\Helpme::where('status','Accepted')->count();
 $rejected = \App\Models\Helpme::where('status','Rejected')->count();
 $unseen = \App\Models\Helpme::where('seen',0)->count();
 @endphp

    <script src="{{ asset('js/echarts.min.js') }}"></script>
    <script src="{{ asset('js/chartisan_echarts.js') }}"></script>
    <script src="{{ asset('js/echarts-en.min.js') }}"></script>
    <script src="{{ asset('js/highcharts.js') }}"></script>
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
        document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: '@lang('home.users')'
            },
            xAxis: {
                categories: ['@lang('home.admin')', '@lang('home.staff')', '@lang('home.volunteer')']
            },
            yAxis: {
                title: {
                    text: 'ብዛት'
                }
            },
            series: [{
                name: '@lang('home.users')',
                data: [{{$admins}}, {{$staff}}, {{$volunteers}}]
            }]
        });
    });
      </script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('helpmes', {
            chart: {
                type: 'bar'
            },
            title: {
                text: '@lang('home.help_me')'
            },
            xAxis: {
                categories: ['@lang('home.pending')', '@lang('home.accepted')', '@lang('home.rejected')','@lang('home.unseen')']
            },
            yAxis: {
                title: {
                    text: '@lang('home.number')'
                }
            },
            series: [{
                name: '@lang('home.help_me')',
                data: [{{$pending}}, {{$accepted}}, {{$rejected}},{{$unseen}}]
            }]
        });
    });
      </script>
@endsection