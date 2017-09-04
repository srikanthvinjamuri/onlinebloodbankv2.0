<?php
 $data = json_decode(file_get_contents("php://input"));  
$conn = NEW mysqli("localhost","root","","bloodsystem");
$username = $data->username;
$password = md5($data->password);

//echo("<script>console.log('PHP: ".$password."');</script>");

if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
   session_start();

   $sql = "SELECT * FROM user where email='$username' and password='$password'";
$result = $conn->query($sql);

  
  if ($result->num_rows > 0) {
    // output data of each row
     
     $data = array() ;
    while($row = $result->fetch_assoc()) {
      $_SESSION['id']= $row['email'];
        $data[] = $row;
        echo  "1";
    }
} else {
    echo "0";
}



 $conn->close();    

 ?>


   