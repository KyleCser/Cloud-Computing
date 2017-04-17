@include('partials/header')

@extends('layouts.app')
@section('content')


<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.28/angular.min.js"></script>
    <script type="text/javascript">
    	var app = angular.module("Scorecard", []);

    	(function() {
	   	    'use strict';
	   	    
   	        angular
   	            .module('ViewScorecard', [])
	   	        .controller('ViewScorecardController', ViewScorecardController);

   	       ViewScorecardController.$inject = ['$scope'];
   	       /* @ngInject */
   	       function ViewScorecardController($scope) {
				var vm = this;
				vm.title = 'ViewScorecardController';

				$scope.scorecards = {!! json_encode($results) !!}; 

				activate();

				////////////////

				function activate() {
				}
   	       }
   	    })();
    </script>
</head>
<div class="container" ng-app="ViewScorecard" ng-controller="ViewScorecardController as vm">
    <div class="row">
        <div class="col-xs-12">
            @if ($results == null) 
                <h1> You do not have any scorecards </h1>
            @else 
                <h1> Displaying @{{ scorecards.length }} scorecards </h1>
                
                <div class="table-responsive">
		            <table ng-repeat="scorecard in scorecards" class="table table-condensed table-bordered table-striped table-bordered">
		            	<thead>
		            		<tr>
		            			<th>Hole</th>
			            		<th ng-repeat="hole in scorecard"> @{{ hole.number }} </th>
			            	</tr>
			            	<tr>
			            		<th>Distance (ft)</th>
			            		<th ng-repeat="hole in scorecard"> @{{ hole.distance }} </th>	
			            	</tr>
			            	<tr>
			            		<th>Par</th>
			            		<th ng-repeat="hole in scorecard"> @{{ hole.par }} </th>	
			            	</tr>
		            	</thead>
		            	<tbody>
		            		<tr>
		            			<td>Score</td>
			            		<td ng-repeat="hole in scorecard"> @{{ hole.score }} </td>	
			            	</tr>
		            	</tbody>
		            </table>
		        </div>
            @endif
        </div>
    </div>
</div>

@stop
