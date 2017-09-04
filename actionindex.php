<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script>
    angular.module("crudApp", [])
.controller("userController", function($scope,$http){
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
</script>
<style>
    /* required style*/ 
.none{display: none;}

/* optional styles */
table tr th, table tr td{font-size: 1.2rem;}
.row{ margin:20px 20px 80px 20px;width: 90%;}
.glyphicon{font-size: 20px;}
.glyphicon-plus{float: right;}
a.glyphicon{text-decoration: none;cursor: pointer;}
.glyphicon-trash{margin-left: 10px;}
.alert{
    width: 50%;
    border-radius: 0;
    margin-top: 10px;
    margin-left: 10px;
}
</style>
    <html>
        <body>
<div  ng-controller="userController" ng-init="getRecords()">
    <div class="row">
        <div class="panel panel-default users-content">
            <div class="panel-heading">Users <a href="javascript:void(0);" class="glyphicon glyphicon-plus" onclick="$('.formData').slideToggle();"></a></div>
            <div class="alert alert-danger none"><p></p></div>
            <div class="alert alert-success none"><p></p></div>
            <div class="panel-body none formData">
                <form class="form" name="userForm">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" ng-model="tempUserData.name"/>
                    </div>
                    
                   
                    
        <div class="form-group">
            <label for="gender">Gender</label>&emsp; &emsp;&emsp; &emsp;
            <input type="radio" name="gender" value="male" checked ng-model="tempUserData.gender"> Male &emsp; &emsp;&emsp; &emsp; &emsp; &emsp;
            <input type="radio" name="gender" value="female" ng-model="tempUserData.gender"> Female<br>
         
        </div> 
         <div class="form-group">
            <label for="blood">Blood Group</label>
            <select class="form-control" data-size="5" name="blood" ng-model="tempUserData.blood"> 
                 
                 <option >Select </option> 
        <option >A+</option>
        <option>B+</option>
        <option>0+</option>
        <option>A-</option>
        <option>B-</option>
        <option>0-</option>
        <option>AB+</option>
        <option>AB-</option>
        <option>A</option>
        
                 </select>
            
        </div>
            <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" ng-model="tempUserData.phone"/>
                    </div>
         <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control" ng-model="tempUserData.weight"/>
          
        </div>
           <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" class="form-control"  ng-model="tempUserData.age"/>
          
        </div>
            <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city"  class="form-control" ng-model="tempUserData.city"/>
          
        </div>
           <div class="form-group">
            <label for="area">Area</label>
            <input type="text"  name="area" class="form-control" ng-model="tempUserData.area" />
          
        </div>
         <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" ng-model="tempUserData.email"/>
                    </div>
                     <div class="form-group">
                        <label>password</label>
                        <input type="text" class="form-control" name="password" ng-model="tempUserData.password"/>
                        <br>
                        <button  type="submit" ng-click="message()"> SEND MESSAGE</button>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('.formData').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" ng-hide="tempUserData.id" ng-click="addUser()">Add User</a>
                    <a href="javascript:void(0);" class="btn btn-success" ng-hide="!tempUserData.id" ng-click="updateUser()">Update User</a>
                </form>
            </div>
            <table class="table table-striped">
                <tr>
                     <th width="5%">Sno</th>
                     <th width="10%">Name</th>
                     <th width="10%">gender</th>
                     <th width="10%">blood_group</th>
                     <th width="10%">Phone</th>
                     <th width="10%">weight</th>
                     <th width="10%">age</th>
                     <th width="10%">city</th>
                     <th width="10%">area</th>
                     <th width="10%">Email</th>
                      <th width="10%">password</th>
<!--                     <th width="14%">Created</th>-->
                     <th width="10%">option</th>
                  </tr>
                  <tr ng-repeat="user in users | orderBy:'-created'">
                     <td>{{$index + 1}}</td>
                     <td>{{user.name}}</td>
                     <td>{{user.gender}}</td>
                     <td>{{user.blood}}</td>
                     <td>{{user.phone}}</td>
                     <td>{{user.weight}}</td>
                     <td>{{user.age}}</td>
                     <td>{{user.city}}</td>
                     <td>{{user.area}}</td>
                     <td>{{user.email}}</td>
                      <td>{{user.password}}</td>
<!--                     <td>{{user.created}}</td>-->
                     <td>
                        <a href="javascript:void(0);" class="glyphicon glyphicon-edit" ng-click="editUser(user)"></a>
                        <a href="javascript:void(0);" class="glyphicon glyphicon-trash" ng-click="deleteUser(user)"></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
        <body
    </html>
