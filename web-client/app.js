

'use strict';
var serviceBase = 'http://localhost/roleLogin/backend/web/'
// Declare app level module which depends on views, and components
var spaApp = angular.module('spaApp', [
  'ngRoute',
  'spaApp.site',
  'spaApp.computer',
  'spaApp.student'
 ]);
var spaApp_site = angular.module('spaApp.site', ['ngRoute']);
var spaApp_student = angular.module('spaApp.student', ['ngRoute','checklist-model']);
var spaApp_computer = angular.module('spaApp.computer', ['ngRoute']);

//spaApp.config(['$routeProvider', function($routeProvider) {
//  $routeProvider.otherwise({
//      redirectTo: '/student/index'
//  });
//}]);