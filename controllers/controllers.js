app.controller('empController', function($route,$scope,$http,$routeParams,sharedProperties){
	
    alert("kkk");
    $scope.getEmployees = function(){

$scope.var = sharedProperties.property; 
               alert( $scope.var);
//            $http.get('../api/select.php',{'username':)
//                        .then(function(response){
//			$scope.users = response.data;
//		});           
	};
	$scope.addEmployee = function(info){
		$http.post('../api/insert.php', info).then(function(response){
			window.location.href = 'http://localhost/crud_APM3/client/#/';
		});
	};
	$scope.showEmployee = function(){
		var id = $routeParams.id;
		$http.post('../api/selectone.php',{'id':id}).then(function(response){
			var emp  = response.data;
			$scope.user= emp[0];
		});
	};
	$scope.updateEmployee = function(info){
		$http.post('../api/update.php', info).then(function(response){
			window.location.href = 'http://localhost/client/templates/list.html#/';
		});
	};
	$scope.deleteEmployee = function(id){
		var id = id;
		$http.post('../api/delete.php',{'id':id}).then(function(response){
//			$route.reload();
window.location.href = 'http://localhost/updatemodify/client/index.html#/';
		});
	};

});
  