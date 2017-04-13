@extends('Layouts.app')
@section('content')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Javascript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>

@include('partials/header')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="container">
                <div class="jumbotron">
                    <div class="container">
                        <h1> Disc Golf Manager </h1>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <button class="btn btn-primary btn-lg"> New Scorecard </button>

                                <button class="btn btn-success btn-lg"> View Statistics </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
