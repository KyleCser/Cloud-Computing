@include('partials/header')

@extends('layouts.app')
@section('content')

<h1>Registration Form</h1><hr>
<h3>Please insert the informations bellow:</h3>
{{Form::open(array('url'=>'test/register','method'=>'post'))}}
<input type="text" name="username" placeholder="username"><br><br>
<input type="text" name="email" placeholder="email"><br><br>
<input type="password" placeholder="password"><br><br>
<input type="submit" value="REGISTER NOW!">
{{Form::close()}}
@stop