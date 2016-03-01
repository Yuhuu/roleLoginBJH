/* 
 * Copyright(C) 2016.  All rights reserved to Bjørnholt school. 
 * https://bjornholt.osloskolen.no/
 * @author Created by Bachelor Final Project group 18 at Oslo and Akershus University College 
 * Creating interactive web pages using the Angualr framework carried out by:
 * Martin Hansen Muren Mathisen (s189116), Waqas Liaqat (s180364), 
 * Yuanxin Huang (s184519), Thanh Nguyen Chu (s169954)
 * @version 1.01.01
 */
/* global angular */

//(function(){
    var app = angular.module('atTheStudents',[
        'ngRoute',
        'mgcrea.ngStrap',   //bs-navbar, data-match-route directives
        'controllers'       //Our module frontend/web/js/controllers.js
]);
//   Configuration blocks get executed during the provider 
//   registrations and configuration phase. Only providers 
//   and constants can be injected into configuration blocks. 
//   This is to prevent accidental instantiation of services
//    before they have been fully configured 
    app.config(['$routeProvider', '$httpProvider', 
        function($routeProvider, $httpProvider) {
        $routeProvider
                .when("/",
        {
            templateUrl:"/views/index.html"})
                .when("/details/:id",
        {
            templateUrl:"/views/detail.html"})
                .otherwise({
            redirectTo:"/"
    });
    // AUTHINTERCEPTOR WwILL ADD THE TOKEN
    $httpProvider.interceptors.push('authInterceptor');
    }
    ]);
app.factory('authInterceptor', function ($q, $window, $location) {
    return {
        request: function (config) {
            if ($window.sessionStorage.access_token) {
                //HttpBearerAuth
                config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;
            }
            return config;
        },
        responseError: function (rejection) {
            if (rejection.status === 401) {
                $location.path('/login').replace();
            }
            return $q.reject(rejection);
        }
    };
});
//}());


    