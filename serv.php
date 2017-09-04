<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT city,area FROM chartdata";  //This is where I specify what data to query
$result = mysqli_query($conn, $sql);

$data = array();
while($enr = mysqli_fetch_assoc($result)){
    $a = array($enr['city'], $enr['area']);
    array_push($data, $a);
}

echo json_encode($data);
?>