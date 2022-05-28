@extends('layouts.admin')

@section('content')
    <style>
        .mybox {
            border: solid;
            border-width: 0.5px;
            border-top-right-radius: 10px;

        }

        .hisbox {}

    </style>
    <div class="card-header">
        Featured
    </div>
    <div class=" row d-flex flex-column justify-content-start">

        <div class="col text-left" style="">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

        </div>
        <div class="col text-right" style="text-align: right; display: inline-block;">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

        </div>
    </div>
@endsection
