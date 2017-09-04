<?php 
$data = json_decode(file_get_contents("php://input"));
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "UPDATE user SET 
name ='$data->name',gender='$data->gender', blood ='$data->blood',phone='$data->phone',weight='$data->weight',age='$data->age',
         city='$data->city',area ='$data->area',
email ='$data->email',password='$data->password' WHERE id = $data->id ";

$qry = $conn->query($sql);
$conn->close();
?>