
<?php 

$data = json_decode(file_get_contents("php://input"));  
$email= $data->email;
$password= md5($data->password);


$conn = NEW mysqli("localhost","root","","bloodsystem");
 if($conn->connect_error){
     die("Connection failed");
 }

 $sql = "SELECT email from user where email='$email'";
 if($conn->query($sql) == TRUE) {

     $sql1="update user set password='$password' where email='$email'";
      if($conn->query($sql1) == TRUE) {
              echo "<script>console.log( 'Debug Objects:2' );</script>";
 }
 }
 else {
     echo "error ". $conn->error;
 }
  
 $conn->close();






?>

