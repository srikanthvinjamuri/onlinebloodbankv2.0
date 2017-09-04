<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <script language="javascript" type="text/javascript" src="flot/jquery.js"></script>       <!-- jQuery library -->
    <script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>  <!-- Library with charts that I plan to use -->
    <script type="text/javascript">

    $.ajax({
       url : 'serv.php', // my php file
       type : 'GET', // type of the HTTP request
       success : function(data){ 
          var obj = jQuery.parseJSON(data);
          console.log(obj);
       }
    });

    </script>   
</head>
<body>
Hi
</body>
</html
<?php
if(isset($_POST['s1'])){
    $link= mysqli_connect('localhost', 'root','');
    mysqli_select_db($link, 'bloodsystem');
    $count= mysqli_query($link, "select count(*) from  registration");
    $name=$_POST['t1'];
    $gender=$_POST['r1'];
    $age=$_POST['t2'];
    $weight=$_POST['t3'];
    $blood_group=$_POST['t4'];
    $email_id=$_POST['t5'];
    $phone=$_POST['t6'];
    $city=$_POST['t7'];
    $location=$_POST['t8'];
    $password=$_POST['t9'];
    $result=mysqli_query($link,"insert into registration values('$name','$gender','$age','$weight','$blood_group','$email_id','$phone','$city','$location','$password')");
 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 $count1 = mysqli_num_rows($result);
  if($count1>$count) {
      echo '$name';
  } 
 
 
 $conn->close();
       
}
?>