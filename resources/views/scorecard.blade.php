@include('partials/header')

@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            @if ($scorecard == null) 
                <h1> You do not have any scorecards </h1>
            @else 
                <h1> Displaying X scorecards </h1>
            @endif
        </div>
    </div>
</div>

@stop
