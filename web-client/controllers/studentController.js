'use strict';
spaApp_student.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
                .when('/student/index', {
                    templateUrl: 'views/student/index.html',
                    controller: 'index'
                })
                .when('/student/create', {
                    templateUrl: 'views/student/create.html',
                    controller: 'create',
                    resolve: {
                        student: function (studentservices, $route) {
                            return studentservices.getStudents();
                        }
                    }
                })
                .when('/student/update/:studentId', {
                    templateUrl: 'views/student/update.html',
                    controller: 'update',
                    resolve: {
                        student: function (studentservices, $route) {
                            var studentId = $route.current.params.studentId;
                            return studentservices.getStudent(studentId);
                        }
                    }
                })
                .when('/student/delete/:studentId', {
                    templateUrl: 'views/student/index.html',
                    controller: 'delete',
                })
                .otherwise({
                    redirectTo: '/student/index'
                });
    }]);

/* 
controller til module student, studentservices is defined in student.js under models
 */
spaApp_student.controller('index', ['$scope', '$http', 'studentservices',
    function ($scope, $http, studentservices) {
        
        $scope.message = 'Everyone come and see how good I look!';
            
        $scope.student_equipment = {
        students: []
        };
        //
        studentservices.getStudents().then(function (data) {
            $scope.students = data.data;
        });

        $scope.checkAll = function () {
            $scope.student_equipment.students = $scope.students.map(function (item) {
                return item.id;
            });
        };
        $scope.uncheckAll = function () {
            $scope.student_equipment.students = [];
        };
        $scope.deleteStudent = function (studentID) {
            if (confirm("Are you sure to delete student number: " + studentID) == true && studentID > 0) {
                studentservices.deleteStudent(studentID);
                $route.reload();
            }
        };
    }])
        .controller('create', ['$scope', '$http', 'studentservices', '$location', 'student',
            function ($scope, $http, studentservices, $location, student) {
                $scope.createStudent = function (student) {
                    var results = studentservices.createStudent(student);
                }
            }])
        .controller('update', ['$scope', '$http', '$routeParams', 'studentservices', '$location', 'student',
            function ($scope, $http, $routeParams, studentservices, $location, student) {
                var original = student.data;
                $scope.student = angular.copy(original);
                $scope.isClean = function () {
                    return angular.equals(original, $scope.student);
                }
                $scope.updateStudent = function (student) {
                    var results = studentservices.updateStudent(student);
                }
            }]);