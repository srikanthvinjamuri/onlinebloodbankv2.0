<?php
$data = json_decode(file_get_contents("php://input"));
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "DELETE FROM user WHERE id = $data->id ";
$result = $conn->query($sql);
$conn->close();
?>