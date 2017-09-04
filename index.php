<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html ng-app="Demo">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ONLINE BLOOD DONATION SYSTEM</title>
        <link rel="icon" href="images/download.jpg" type="image/gif" sizes="16x16">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js" ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-route.min.js" ></script>
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/animate.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/footer-distributed.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/main.css" rel="stylesheet" type="text/css"/>
        <link href="lib/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/script.js" type="text/javascript"></script>
<!--    <script src="controllers/controllers.js" type="text/javascript"></script>-->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           <link href="CSS/app.css" rel="stylesheet" type="text/css"/>
<!--           <script src="../login/login.controller.js" type="text/javascript"></script>
        <script src="../register/register.controller.js" type="text/javascript"></script>-->
        <script src="js/flash.service.js" type="text/javascript"></script>
        <script src="js/authentication.service.js" type="text/javascript"></script>
        <script src="js/user.service.js" type="text/javascript"></script>
        <script src="js/user.service.local-storage.js" type="text/javascript"></script>
       <script>
           function validate()
           {
               if(document.getElementById("combo").value== '0'){
                   document.getElementById('spanmsg').innerHTML="select required bloodgroup";
               }
           }
           </script>
    </head>
  
    <body>
 <?php

session_start();
?>
         <div class="container-fluid" style="margin-left: 0px ">
             
        <img  src="Images/FINAL.JPG" class="img-responsive" style="width:90%; height:170px;"  />     
     </div>

        <div ng-controller="HeaderCtrl">
        <div ng-include="templateUrl"></div>
    </div>
        
        <div class="container-fluid" >        
            <div class="row" ng-view ">
                
            </div>

    
     
        </div>
        <?php
        // put your code here
        ?>
       
       
    </body>
   
    <footer class="footer-distributed">

			<div class="footer-right container">

				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>

			</div>

			<div class="footer-left container">

				<p class="footer-links">
					<a href="#/">HOME</a>
					·
					<a href="#/search">SEARCH DON0RS</a>
					·
					<a href="#/bloodtips">BLOOD TIPS</a>
					·
					<a href="#/aboutus">ABOUT US</a>
					·
					<a href="#/register">REGISTER AS DONOR</a>
					·
					
				</p>

			</div>

		</footer> 
 
</html>

<?php
if(isset($_POST["submit1"])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
}
 session_start();
 if($_SERVER["REQUEST_METHOD"] == "POST") 
 {
      $error = "";
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM registration WHERE email_id = '$username' and password = '$password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
		
      if($count == 1) 
      {
         $_SESSION['username'] = $username;
         //echo $_SESSION['username'];
//		 if($_SESSION['username']!="jaggu@gmail.com")
//			header("location: index.php");
////		else
//////			header("location: adminindex.php");
  }
      else {
         $error = "Your Login Name or Password is invalid";
      }
   }
   $conn->close();
}
?>

