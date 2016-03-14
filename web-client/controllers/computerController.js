'use strict';
spaApp_computer.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
                .when('/computer/index', {
                    templateUrl: 'views/computer/index.html',
                    controller: 'index'
                })
                .when('/computer/create', {
                    templateUrl: 'views/computer/create.html',
                    controller: 'create',
                    resolve: {
                        computer: function (computerservices, $route) {
                            return computerservices.getComputers();
                        }
                    }
                })
                .when('/computer/update/:computerId', {
                    templateUrl: 'views/computer/update.html',
                    controller: 'update',
                    resolve: {
                        computer: function (computerservices, $route) {
                            var computerId = $route.current.params.computerId;
                            return computerservices.getComputer(computerId);
                        }
                    }
                })
                .when('/computer/delete/:computerId', {
                    templateUrl: 'views/computer/index.html',
                    controller: 'delete',
                })
                .otherwise({
                    redirectTo: '/computer/index'
                });
    }]);

/* 
controller til module computer, computerservices is defined in computer.js under models
 */

spaApp_computer.controller('index', ['$scope', '$http', 'computerservices',
    function ($scope, $http, computerservices) {
        
        $scope.message = 'Everyone come and see how good I look!';    
//        $scope.computer_equipment = {
//            computers: []
//        };
        //
        computerservices.getComputers().then(function (data) {
            $scope.computers = data.data;
        });

        $scope.deleteComputer = function (computerID) {
            if (confirm("Are you sure to delete computer number: " + computerID) == true && computerID > 0) {
                computerservices.deleteComputer(computerID);
                $route.reload();
            }
        };
    }])
        .controller('create', ['$scope', '$http', 'computerservices', '$location', 'computer',
            function ($scope, $http, computerservices, $location, computer) {
                $scope.message = 'Look! I am an about page.';
                $scope.createComputer = function (computer) {
                    var results = computerservices.createComputer(computer);
                }
            }])
        .controller('update', ['$scope', '$http', '$routeParams', 'computerservices', '$location', 'computer',
            function ($scope, $http, $routeParams, computerservices, $location, computer) {
                $scope.message = 'Contact us! JK. This is just a demo.';
                var original = computer.data;
                $scope.computer = angular.copy(original);
                $scope.isClean = function () {
                    return angular.equals(original, $scope.computer);
                }
                $scope.updateComputer = function (computer) {
                    var results = computerservices.updateComputer(computer);
                }
            }]);