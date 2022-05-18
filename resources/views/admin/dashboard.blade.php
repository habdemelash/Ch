@extends('layouts.admin')
@section('content')
<div class="row d-flex justify-content-md-between">
    <div class="col text-center mb-3">
        <h4>{{__('home.analytics_dash')}}</h4>
        
    </div>
</div>
<div class="row text-center">
    
    <div class="col-md-4" id="events" style="height: 300px;">
        <strong class="text-center text-primary">@lang('home.events_nav')</strong>
    </div>
    <div class="col-md-4" id="users" style="height: 300px;">
        <strong class="text-center text-primary">@lang('home.users')</strong>
    </div>
</div>




    <script src="{{asset('js/echarts.min.js')}}"></script>
    <script src="{{asset('js/chartisan_echarts.js')}}"></script>
    <script src="{{asset('js/echarts-en.min.js')}}"></script>
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
    </script>
@endsection