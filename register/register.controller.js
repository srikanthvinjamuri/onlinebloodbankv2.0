(function () {
    'use strict';

    angular
        .module('Demo')
        .controller('RegisterController', RegisterController);

    RegisterController.$inject = ['registerService', '$location', '$rootScope', 'FlashService'];
    function RegisterController(UserService, $location, $rootScope, FlashService) {
        var vm = this;

        vm.register = register;

        function register() {
            vm.dataLoading = true;
            UserService.Create(vm.user)
                .then(function (response) {
                    if (response.success) {
                        FlashService.Success('Registration successful', true);
                        $location.path('#/login');
                    } else {
                        FlashService.Error(response.message);
                        vm.dataLoading = false;
                    }
                });
        }
    }

})();
 app.controller('loginCtrl',function($scope,$location,$window){
    $scope.submit =function(){
        var uname=$scope.username;
        var password=$scope.password;
              
        if($scope.username === 'jaggu@gmail.com' && $scope.password === '21343'){
          
          $("#isUserLoggedIn").hide();
            $window.location.reload();
          
            $location.path('/dashboard');
          
            
        }
    };
     });