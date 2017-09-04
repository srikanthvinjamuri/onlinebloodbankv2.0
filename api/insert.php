<?php 
$data = json_decode(file_get_contents("php://input"));
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO employees (name, dept, area, status,contact, salary) 
VALUES ('$data->name', '$data->dept', '$data->area', '$data->status','$data->contact', '$data->salary')";
$qry = $conn->query($sql);
$conn->close();
?>