@extends('layouts.app')
@section('content')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Disc Golf Manager</title>

    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        #scorecards h1, #statistics h1 {
            border-bottom: 1px solid #eee; 
        }
    </style>
</head>

<?php
    $userInfo = Auth::user();
?>

@include('partials/header')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="container">
                <div class="jumbotron">
                    <div class="container">
                        <h1> Disc Golf Manager </h1>
                        
                        @if(Auth::check())
                            <p> Welcome, <?php echo $userInfo->name; ?>. </p>
                        @endif
                    </div>
                </div>

                @if(Auth::check())
                    <div class="row">
                        <div id="scorecards" class="col-xs-12">
                            <h1> Scorecards </h1>
                            
                            <a class="btn btn-primary" href="{{ route('scorecard.show', ['id' => $userInfo->id]) }}"> 
                                <i class="fa fa-eye"></i> 
                                View Scorecards 
                            </a>
                            
                            <a class="btn btn-success" href="{{ route('scorecard.create') }}"> 
                                <i class="fa fa-plus"></i> 
                                New Scorecard 
                            </a>
                        </div>

                        <div id="statistics" class="col-xs-12">
                            <h1> Statistics </h1>

                            <button class="btn btn-info"> 
                                <i class="fa fa-line-chart"></i>
                                View Statistics 
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
