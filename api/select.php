<?php
$data = json_decode(file_get_contents("php://input"));
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";
$conn = new mysqli($servername, $username, $password, $dbname);
$user = $data->username;

$sql = "SELECT * FROM user where email='$user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

     $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
echo json_encode($data);
$conn->close();
?>