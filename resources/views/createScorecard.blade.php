@include('partials/header')

@extends('layouts.app')
@section('content')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.28/angular.min.js"></script>
    <script type="text/javascript">
    	var app = angular.module("Scorecard", []);

    	(function() {
	   	    'use strict';
	   	    
	   	    app.controller('ScorecardController', ScorecardController);
	   	    ScorecardController.$inject = ['$scope', 'ScorecardFactory'];
	   	    /* @ngInject */
	   	    function ScorecardController($scope, ScorecardFactory) {
	   	        var vm = this;
	   	        vm.title = 'ScorecardController';
	   	        vm.submitScorecard = submitScorecard;
	   	        activate();
	   	        
	   	        $scope.scorecard = {
	   	        	holes: [
	   	        		{ 
	   	        			number:1, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:2, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:3, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:4, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:5, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:6, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:7, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:8, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:9, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:10, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:11, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:12, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:13, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:14, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:15, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:16, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:17, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		},
	   	        		{ 
	   	        			number:18, 
	   	        			distance: 325, 
	   	        			par:3
	   	        		}
	   	        	]
	   	        }

	   	        ////////////////

	   	        function activate() {
	   	        }

	   	        function submitScorecard() {
	   	        	$scope.results = $scope.scorecard;
	   	        	angular.forEach($scope.scorecard.holes, function(hole, index) {
	   	        		var score = $("#hole_" + hole.number + " input").val();

	   	        		$scope.scorecard.holes[index].score = parseInt(score);	 
	   	        	});

	   	        	ScorecardFactory.store($scope.scorecard);
	   	        }
	   	    }

   	        app.factory('ScorecardFactory', ScorecardFactory);
   	        ScorecardFactory.$inject = ['$q', '$http'];
	   	    /* @ngInject */
   	        function ScorecardFactory($q, $http) {
   	            var service = {
   	                getScorecards: getScorecards,
   	                store: store
   	            };
   	            return service;

   	            ////////////////

   	            function getScorecards() {
   	            }

   	            function store(scorecard) {
                	var promise = $q.defer();

                	console.log(scorecard);

   	            	$http({
                        method: "POST",
                        url: "/scorecard/store",
                        data: $.param({
                        	results: scorecard.holes
                        }),
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        }
                    })
                    .success(function(result) {
                    	console.log(result);
                        promise.resolve(result);
                    })
                    .error(function(data, status) {
                        console.log(data, status);
                        promise.reject(null);
                    });

	                return promise.promise;
	            }
   	        }
   	    })();
    </script>
</head>

<div class="row" ng-app="Scorecard" ng-controller="ScorecardController as vm">
    <div class="col-xs-12 col-lg-10 col-lg-offset-1">
    	<div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped table-hover table-bordered">
            	<thead>
            		<tr>
            			<th>Hole</th>
	            		<th ng-repeat="hole in scorecard.holes"> @{{ hole.number }} </th>
	            	</tr>
	            	<tr>
	            		<th>Distance (ft)</th>
	            		<th ng-repeat="hole in scorecard.holes"> @{{ hole.distance }} </th>	
	            	</tr>
	            	<tr>
	            		<th>Par</th>
	            		<th ng-repeat="hole in scorecard.holes"> @{{ hole.par }} </th>	
	            	</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<td>Score</td>
	            		<td ng-repeat="hole in scorecard.holes" id="hole_@{{ hole.number }}">
	            			<input type="number" min="1" max="9" value="3" required="true">
	            		</td>	
	            	</tr>
            	</tbody>
            </table>
        </div>
        
        <div class="row">
        	<div class="col-xs-12">
        		<button class="btn btn-lg btn-success" type="button" ng-click="vm.submitScorecard()"> Submit </button>
        	</div>
        </div>
    </div>
</div>

@stop
