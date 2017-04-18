@include('partials/header')

@extends('layouts.app')
@section('content')


<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.28/angular.min.js"></script>
    <script type="text/javascript">
    	var app = angular.module("Stats", []);

    	(function() {
	   	    'use strict';
	   	    
   	        angular
   	            .module('ViewStats', [])
	   	        .controller('ViewStatsController', ViewStatsController);

   	       ViewStatsController.$inject = ['$scope'];
   	       /* @ngInject */
   	       function ViewStatsController($scope) {
				var vm = this;
				vm.title = 'ViewStatsController';

				$scope.scorecards = {!! json_encode($results) !!}; 

				activate();

				////////////////

				function activate() {
					var bestAndWorst = getBestWorstScorecards();
					$scope.bestScorecard = bestAndWorst.best;
					$scope.worstScorecard = bestAndWorst.worst;
					$scope.average = getAverageScore();
				}

				function getBestWorstScorecards() {
					var bestScorecard, bestScore,
						worstScorecard, worstScore;

					angular.forEach($scope.scorecards, function(scorecard) {
						var score = 0, totalPar = 0, totalDistance = 0;
						
						angular.forEach(scorecard, function(hole) {
							score += parseInt(hole.score);
							totalPar += parseInt(hole.par);
							totalDistance += parseInt(hole.distance);
						});

						scorecard.score = score;
						scorecard.totalPar = totalPar;
						scorecard.totalDistance = totalDistance;

						if (score < bestScore || bestScore === undefined) {
							bestScore = score;
							bestScorecard = scorecard;
						}

						if (score > worstScore || worstScore === undefined) {
							worstScore = score;
							worstScorecard = scorecard;
						}
					});

					return { best: bestScorecard, worst: worstScorecard };
				}

				function getAverageScore() {
					var average, totalScore = 0, totalPar = 0; 

					angular.forEach($scope.scorecards, function(scorecard) {
						var score = 0, scorecardTotalPar = 0, totalDistance = 0;
						
						angular.forEach(scorecard, function(hole) {
							score += parseInt(hole.score);
							scorecardTotalPar += parseInt(hole.par);
							totalDistance += parseInt(hole.distance);
						});

						scorecard.score = score;
						scorecard.totalPar = scorecardTotalPar;
						scorecard.totalDistance = totalDistance;

						totalScore += scorecard.score;
						totalPar += scorecard.totalPar;
					});

					average = Math.round(((totalScore - totalPar) / $scope.scorecards.length) * 100) / 100;
					
					return {
						average: average, 
						totalScore: totalScore, 
						totalPar: totalPar
					}
				}
   	       }
   	    })();
    </script>
</head>
<?php 
	$user = Auth::user();
?>
<div class="container" ng-app="ViewStats" ng-controller="ViewStatsController as vm">
    <div class="row">
        <div class="col-xs-12">
        	<div class="page-header">
        		<h1> {{ $user->name }} Statistics </h1>
        	</div>

            @if ($results == null) 
                <h2> You do not have any scorecards </h2>
            @else 
                <h2> @{{ scorecards.length }} completed scorecards </h2>
                
                <div class="table-responsive">
                	<h2> Best Scorecard </h2>
		            <table class="table table-condensed table-bordered table-striped table-bordered">
		            	<thead>
		            		<tr>
		            			<th>Hole</th>
			            		<th ng-repeat="hole in bestScorecard"> @{{ hole.number }} </th>
			            		<th>Totals</th>
			            	</tr>
			            	<tr>
			            		<th>Distance (ft)</th>
			            		<th ng-repeat="hole in bestScorecard"> @{{ hole.distance }} </th>	
			            		<td> @{{ bestScorecard.totalDistance }} </td>	
			            	</tr>
			            	<tr>
			            		<th>Par</th>
			            		<th ng-repeat="hole in bestScorecard"> @{{ hole.par }} </th>	
			            		<td> @{{ bestScorecard.totalPar }} </td>	
			            	</tr>
		            	</thead>
		            	<tbody>
		            		<tr>
		            			<td>Score</td>
			            		<td ng-repeat="hole in bestScorecard"> @{{ hole.score }} </td>
			            		<td> @{{ bestScorecard.score }} (@{{ (bestScorecard.score - bestScorecard.totalPar > 0) ? '+' : '' }}@{{ bestScorecard.score - bestScorecard.totalPar }}) </td>	
			            	</tr>
		            	</tbody>
		            </table>
		        </div>

		        <div class="table-responsive">
                	<h2> Worst Scorecard </h2>
		            <table class="table table-condensed table-bordered table-striped table-bordered">
		            	<thead>
		            		<tr>
		            			<th>Hole</th>
			            		<th ng-repeat="hole in worstScorecard"> @{{ hole.number }} </th>
			            		<th>Totals</th>
			            	</tr>
			            	<tr>
			            		<th>Distance (ft)</th>
			            		<th ng-repeat="hole in worstScorecard"> @{{ hole.distance }} </th>	
			            		<td> @{{ worstScorecard.totalDistance }} </td>	
			            	</tr>
			            	<tr>
			            		<th>Par</th>
			            		<th ng-repeat="hole in worstScorecard"> @{{ hole.par }} </th>	
			            		<td> @{{ worstScorecard.totalPar }} </td>	
			            	</tr>
		            	</thead>
		            	<tbody>
		            		<tr>
		            			<td>Score</td>
			            		<td ng-repeat="hole in worstScorecard"> @{{ hole.score }} </td>
			            		<td> @{{ worstScorecard.score }} (@{{ (worstScorecard.score - worstScorecard.totalPar > 0) ? '+' : '' }}@{{ worstScorecard.score - worstScorecard.totalPar }}) </td>	
			            	</tr>
		            	</tbody>
		            </table>
		        </div>

		        <div>		        	
	        		<h2>Average Score</h2> 
	        		@{{ average.average }}

	        		<h2>Total Score</h2> 
	        		@{{ average.totalScore }}

	        		<h2>Total Par</h2> 
	        		@{{ average.totalPar }}
		        </div>
            @endif
        </div>
    </div>
</div>

@stop
