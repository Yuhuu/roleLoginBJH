'use strict';
/* 
service CRUD til module computer
 */
spaApp_computer.factory("computerservices", ['$http','$location','$route', 
	function($http,$location,$route) {
    var obj = {};
    obj.getComputers = function(){
        return $http.get(serviceBase + 'computers');
    }	
	obj.createComputer = function (computer) {
		return $http.post( serviceBase + 'computers', computer )
			.then( successHandler )
			.catch( errorHandler );
		function successHandler( result ) {
			$location.path('/computer/index');			
		}
		function errorHandler( result ){
			alert("Error data")
			$location.path('/computer/create')
		}
	};	
	obj.getComputer = function(computerID){
        return $http.get(serviceBase + 'computers/' + computerID);
    }
	
	obj.updateComputer = function (Computer) {
	    return $http.put(serviceBase + 'computers/' + Computer.id, Computer )
			.then( successHandler )
			.catch( errorHandler );
		function successHandler( result ) {
			$location.path('/computer/index');
		}
		function errorHandler( result ){
			alert("Error data")
			$location.path('/computer/update/' + Computer.id)
		}	
	};	
	obj.deleteComputer = function (computerID) {
	    return $http.delete(serviceBase + 'computers/' + computerID)
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