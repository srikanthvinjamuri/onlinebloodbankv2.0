/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/// [reference path="angular.min.js" /]

var app = angular.module("Demo", ["ngRoute"]); 
        app.config(function ($routeProvider) {
            $routeProvider 
            .when("/",
            { templateUrl: "html/homepage.html",
             
       })
         
           .when("/register",
               { templateUrl: "register/register.view.html", 
                controller: "registercontroller" })
           .when("/login",
            { templateUrl: "login/login.view.html",
                 controller:"loginCtrl" })
            .when("/dashboard",
           {templateUrl:"actionindex.php",
                controller:"userController"
           })
       .when("/search",
            { templateUrl: "searchblood/search.html",
               controller: "searchbloodcontroller" })
       .when("/bloodtips",
            { templateUrl: "bloodtips/bloodtips.html",
               controller: "bloodtips.controller" })
         .when("/aboutus", {
		templateUrl:"aboutus.php"	
	})  
         .when("/forgot",
           {templateUrl:"forgotpassword.php",
                controller:"forgotController"
           })
         .when("/userdashboard", {
		templateUrl:"templates/list2.html",
                controller: "empController" 
		
	})
	.when('/employees', {
		templateUrl:'templates/show.html',
		controller:'empController'
	})
	
	.when('/employees/:id/edit', {
		templateUrl:'templates/edit.html',
		controller:'empController'
	})
        .when("/seekerdashboard", {
		templateUrl:"html/donorslist.html",
                controller: "seekerController" 
		
	})
	


});



  app.factory("myService", function() {
    var theValue = {};
    theValue.setter = function(newValue) {
        theValue.value = newValue;
    }
    theValue.getter = function() {
        return theValue.value;
    }
    return theValue;
});   
 app.controller('HeaderCtrl', function($scope, $location) {
    $scope.$on('$locationChangeSuccess', function(/* EDIT: remove params for jshint */) {
        var path = $location.path();
        //EDIT: cope with other path
        $scope.templateUrl = (path==='/userdashboard') ? 'html/navbar.html' :  'html/navbar.php';
    });
})
   app.controller('forgotController',function($scope,$http,$location,myService){
 $scope.submit=function(){
//   var cp=$scope.current+ " ,"+ $scope.password;
//   var password=address2.substring(cp.indexOf(" ")+2,);
//       var email=address2.substring(0,cp.indexOf(" ")); 
console.log("come");
    $http.post("forgot.php", {
		'email':$scope.current,
                'password':$scope.password
            })
            .then(function(response){
               
         
         
         
         
         
         
         
         
              alert("sucessfully updated please login in with updated details");
       $location.path('/login');
          
        
    }); 
   
 };
});  
     
  
    app.controller('registercontroller',function($scope,$http,$location){	
    $scope.regsubmit=function(){		
    $http.post("regrationdatasave.php", {
		'username':$scope.username,
                'gender':$scope.gender,
                'bloodgroup':$scope.bloodgroup,
                'number':$scope.num,
                'weight':$scope.weight,
                'age':$scope.age,
                'city':$scope.city,
                'area':$scope.area,
                'email':$scope.email,
                'password':$scope.password})
    
    .success(function(data){
                document.getElementById("message").textContent = "You have registered successfully";
                alert("You have registered successfully"+data);
                $location.path('/login');
        
    });
        }
         }); 
   
   
    app.controller('loginCtrl',function($scope,$location,$http,$window,myService,$route){
    $scope.submit =function(){
        var username=$scope.username;
        var pass=$scope.password;
        
        var request=$http.post("session.php",{
            'username':$scope.username,
            'password':$scope.password
        },{ headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
          request.success(function(data)
           {
          var i=data;
          console.log(i);
              if(i == 1){
                   console.log("In 21");
                   if(username ==='sreeh@gmail.com' &&  pass==='high'){
                        $location.path('/dashboard');
                        $window.location.reload();
                    }
                    else{
                              $scope.myVar = false;
                              $scope.myVar = !$scope.myVar;
                           console.log("In 0as");
                         myService.setter(username);
                        $location.path('/userdashboard');
//                          $window.location.reload();

$route.reload();
                    }
               }
               else{
                 console.log("In 0");
                   $scope.responseMessage = "Username or Password is incorrect";
            }  

            });
        }  
    });
  

app.controller('searchbloodcontroller',function($scope,$http,$location,myService){
 $scope.showDonors=function(){
    var address =$scope.blood+" ,"+$scope.hospital+", "+$scope.area+", "+$scope.city;
   
 myService.setter(address);
    $location.path('/seekerdashboard');
 };
});


app.controller('seekerController',function($scope,$http,$location,myService){
 $scope.getDonors=function(){
      
     var address2=myService.getter();
     var seekaddr=address2.substring(address2.indexOf(" ")+2,);
//     console.log(seekaddr);
     var city = address2.substring(address2.lastIndexOf(" ")+1,);
     var blood=address2.substring(0,address2.indexOf(" "));
    
     /* distance api*/
      
   
//     function getDistance(source,destination){
//      
//     var service = new google.maps.DistanceMatrixService();
//            service.getDistanceMatrix({
//                origins: [source],
//                destinations: [destination],
//                travelMode: google.maps.TravelMode.DRIVING,
//                unitSystem: google.maps.UnitSystem.METRIC,
//                avoidHighways: false,
//                avoidTolls: false
//            }, function (response, status) {
//                
//                if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
//                    var distance = response.rows[0].elements[0].distance.text;
//                    var duration = response.rows[0].elements[0].duration.text;
//                    
////                    var dvDistance = document.getElementById("dvDistance");
////                    dvDistance.innerHTML = "";
////                    dvDistance.innerHTML += "Distance: " + distance + "<br />";
////                    dvDistance.innerHTML += "Duration:" + duration;
//                        
//                } else {
//                    alert("Unable to find the distance via road.");
//                }
//            });
//        }
       
 $http.post("api/donorslist.php", {
		'city':city,
            'blood':blood,'area':seekaddr})
            .then(function(response){
               
//                  var json=response.data;  
//          
//                  for(var i = 0; i < json.length; i++) {
//                    var data= json[i];
//                    var donoraddr=data.area+","+city;
//                    console.log(getDistance(seekaddr,donoraddr));
//                        json[i].distance =getDistance(seekaddr,donoraddr);
//                        
//                    }
//                
             
              $scope.donors=response.data;
          
        
    }); 
            
 };
});


  app.controller('empController',function($scope,$http,$routeParams,myService,$location){
	

    $scope.getEmployees = function(){


   var user =  myService.getter();
           $http.post('api/select.php',{'username':user})
                       .then(function(response){
                                console.log(response.data);
			$scope.users = response.data;
		});           
	};
	
	$scope.showEmployee = function(){
		var id = $routeParams.id;
		$http.post('api/selectone.php',{'id':id}).then(function(response){
			var emp  = response.data;
			$scope.user= emp[0];
		});
	};
	$scope.updateEmployee = function(info){
		$http.post('api/update.php', info).then(function(response){
//			window.location.href ='http://localhost/finalbloodproject/index.php#/userdashboard';
                        $location.path("/userdashboard");
		});
	};
	$scope.deleteEmployee = function(id){
		var id = id;
		$http.post('api/delete.php',{'id':id}).then(function(response){
//			$route.reload();
//window.location.href = 'http://localhost/updatemodify/client/index.html#/';
 $location.path('/');
		});
	};

});
  
      
  


       
app.controller("userController", function($scope,$http){
    $scope.users = [];
    $scope.tempUserData = {};
    // function to get records from the database
    $scope.getRecords = function(){
        $http.get('action.php', {
            params:{
                'type':'view'
            }
        }).success(function(response){
            if(response.status == 'OK'){
                $scope.users = response.records;
            }
        });
    };
    
      $scope.message = function(){
        $http.post("Donarmsg.php")
    };
    
    
    // function to insert or update user data to the database
    $scope.saveUser = function(type){
        var data = $.param({
            'data':$scope.tempUserData,
            'type':type
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post("action.php", data, config).success(function(response){
            if(response.status == 'OK'){
                if(type == 'edit'){
                         $scope.users[$scope.index].id = $scope.tempUserData.id;
                         $scope.users[$scope.index].name = $scope.tempUserData.name;
                         $scope.users[$scope.index].gender = $scope.tempUserData.gender;
                         $scope.users[$scope.index].blood = $scope.tempUserData.blood;
                         $scope.users[$scope.index].phone = $scope.tempUserData.phone;
                         $scope.users[$scope.index].weight = $scope.tempUserData.weight;
                         $scope.users[$scope.index].age = $scope.tempUserData.age;
                         $scope.users[$scope.index].city = $scope.tempUserData.city;
                         $scope.users[$scope.index].area = $scope.tempUserData.area;
                         $scope.users[$scope.index].email = $scope.tempUserData.email;
                         $scope.users[$scope.index].password = $scope.tempUserData.password;
                         $scope.users[$scope.index].created = $scope.tempUserData.created;
                     }else{
                         $scope.users.push({
                             id:response.data.id,
                             name:response.data.name,
                             gender:response.data.gender,
                             blood:response.data.blood,
                             phone:response.data.phone,
                             weight:response.data.weight,
                             age:response.data.age,
                             city:response.data.city,
                             area:response.data.area,
                             email:response.data.email,
                             password:response.data.password,
                             created:response.data.created
                         });
                         
                     }
                $scope.userForm.$setPristine();
                $scope.tempUserData = {};
                $('.formData').slideUp();
                $scope.messageSuccess(response.msg);
            }else{
                $scope.messageError(response.msg);
            }
        });
    };
    
    // function to add user data
    $scope.addUser = function(){
        $scope.saveUser('add');
    };
    
    // function to edit user data
    $scope.editUser = function(user){
        $scope.tempUserData = {
                 id:user.id,
                 name:user.name,
                 gender:user.gender,
                 blood:user.blood,
                 phone:user.phone,
                 weight:user.weight,
                 age:user.age,
                 city:user.city,
                 area:user.area,
                 email:user.email,
                 password:user.password,
                 created:user.created
             };
        $scope.index = $scope.users.indexOf(user);
        $('.formData').slideDown();
    };
    
    // function to update user data
    $scope.updateUser = function(){
        $scope.saveUser('edit');
    };
    
    // function to delete user data from the database
    $scope.deleteUser = function(user){
        var conf = confirm('Are you sure to delete the user?');
        if(conf === true){
            var data = $.param({
                'id': user.id,
                'type':'delete'    
            });
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }    
            };
            $http.post("action.php",data,config).success(function(response){
                if(response.status == 'OK'){
                    var index = $scope.users.indexOf(user);
                    $scope.users.splice(index,1);
                    $scope.messageSuccess(response.msg);
                }else{
                    $scope.messageError(response.msg);
                }
            });
        }
    };
    
    // function to display success message
    $scope.messageSuccess = function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $('.alert-success').delay(5000).slideUp(function(){
            $('.alert-success > p').html('');
        });
    };
    
    // function to display error message
    $scope.messageError = function(msg){
        $('.alert-danger > p').html(msg);
        $('.alert-danger').show();
        $('.alert-danger').delay(5000).slideUp(function(){
            $('.alert-danger > p').html('');
        });
    };
});
