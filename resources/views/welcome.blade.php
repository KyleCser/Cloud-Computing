@extends('Layouts.app')
@section('content')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles -->
    <style>
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
                            <div class="col-xs-12">
                                <button class="btn btn-primary"> New Scorecard </button>

                                <button class="btn btn-success"> View Statistics </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
