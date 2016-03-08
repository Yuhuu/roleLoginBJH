
var serviceBase = 'http://localhost/roleLogin/backend/web/';
var controllerJS = angular.module('atTheStudents', ['ngAnimate']);
controllerJS.controller('MainController', ['$scope', '$location', '$window',
    function ($scope, $location, $window) {
        $scope.loggedIn = function() {
            return Boolean($window.sessionStorage.access_token);
        };

        $scope.logout = function () {
            delete $window.sessionStorage.access_token;
            $location.path('/login').replace();
        };
    }
]);

//controllerJS.controller('MainController', ['$scope', '$location', '$window',
//    function ($scope, $location, $window) {
//        $scope.loggedIn = function() {
//            return Boolean($window.sessionStorage.access_token);
//        };
//
//        $scope.logout = function () {
//            delete $window.sessionStorage.access_token;
//            $location.path('/login').replace();
//        };
//    }
//]);



//controllers.controller('ContactController', ['$scope', '$http', '$window',
//    function($scope, $http, $window) {
//        $scope.captchaUrl = 'site/captcha';
//        $scope.contact = function () {
//            $scope.submitted = true;
//            $scope.error = {};
//            $http.post('api/contact', $scope.contactModel).success(
//                function (data) {
//                    $scope.contactModel = {};
//                    $scope.flash = data.flash;
//                    $window.scrollTo(0,0);
//                    $scope.submitted = false;
//                    $scope.captchaUrl = 'site/captcha' + '?' + new Date().getTime();
//            }).error(
//                function (data) {
//                    angular.forEach(data, function (error) {
//                        $scope.error[error.field] = error.message;
//                    });
//                }
//            );
//        };
//
//        $scope.refreshCaptcha = function() {
//            $http.get('site/captcha?refresh=1').success(function(data) {
//                $scope.captchaUrl = data.url;
//            });
//        };
//    }]);

controllers.controller('DashboardController', ['$scope', '$http',
    function ($scope, $http) {
        $http.get('api/dashboard').success(function (data) {
           $scope.dashboard = data;
        })
    }
]);

controllers.controller('LoginController', ['$scope', '$http', '$window', '$location',
    function($scope, $http, $window, $location) {
        $scope.login = function () {
            $scope.submitted = true;
            $scope.error = {};
            $http.post('api/login', $scope.userModel).success(
                function (data) {
                    $window.sessionStorage.access_token = data.access_token;
                    $location.path('/dashboard').replace();
            }).error(
                function (data) {
                    angular.forEach(data, function (error) {
                        $scope.error[error.field] = error.message;
                    });
                }
            );
        };
    }
]);
/* 
 * Copyright(C) 2016.  All rights reserved to Bjørnholt school. 
 * https://bjornholt.osloskolen.no/
 * @author Created by Bachelor Final Project group 18 at Oslo and Akershus University College 
 * Creating interactive web pages using the Angualr framework carried out by:
 * Martin Hansen Muren Mathisen (s189116), Waqas Liaqat (s180364), 
 * Yuanxin Huang (s184519), Thanh Nguyen Chu (s169954)
 * @version 1.01.01
 */


