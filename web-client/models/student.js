'use strict';
// factory method to declare service wthin application
spaApp_student.factory("studentservices", ['$http','$location','$route', 
	function($http,$location,$route) {
    var obj = {};
    obj.getStudents = function(){
        return $http.get(serviceBase + 'students');
    }	
	obj.createStudent = function (student) {
		return $http.post( serviceBase + 'students', student )
			.then( successHandler )
			.catch( errorHandler );
		function successHandler( result ) {
			$location.path('/student/index');			
		}
		function errorHandler( result ){
			alert("Error data")
			$location.path('/student/create')
		}
	};	
	obj.getStudent = function(studentID){
        return $http.get(serviceBase + 'students/' + studentID);
    }
	
	obj.updateStudent = function (Student) {
	    return $http.put(serviceBase + 'students/' + Student.id, Student )
			.then( successHandler )
			.catch( errorHandler );
		function successHandler( result ) {
			$location.path('/student/index');
		}
		function errorHandler( result ){
			alert("Error data")
			$location.path('/student/update/' + Student.id)
		}	
	};	
	obj.deleteStudent = function (studentID) {
	    return $http.delete(serviceBase + 'students/' + studentID)
			.then( successHandler )
			.catch( errorHandler );
		function successHandler( result ) {
			$route.reload();
		}
		function errorHandler( result ){
			alert("Error data")
			$route.reload();
		}	
	};	
    return obj;   
}]);