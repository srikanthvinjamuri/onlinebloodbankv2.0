
<?php 
//$data = json_decode(file_get_contents("php://input"));  
//$username = $data->username;
//$gender = $data->gender;
//$bloodgroup = $data->bloodgroup;
//$number = $data->number;
//$weight = $data->weight;
//$age = $data->age;
//$city = $data->city;
//$area = $data->area;
//$email = $data->email;
//$password = $data->password;
//$conn = NEW mysqli("localhost","root","","bloodsystem");
// if($conn->connect_error){
//     die("Connection failed");
// }
//$passwordmd5=md5($password);
// $sql = "INSERT INTO user (name,gender,age,weight,blood,email,phone,city,area,password) VALUES ('$username', '$gender', '$age', '$weight','$bloodgroup','$email','$number','$city','$area','$passwordmd5')";
// if($conn->query($sql) == TRUE) {
//     echo "inserted succesfully";
// }
// else {
//     echo "error ". $conn->error;
// }
// 
// $conn->close();

function getLatLong($address){
    if(!empty($address)){
        //Formatted address
        $formattedAddr = str_replace(' ','+',$address);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
        $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
        $data['latitude']  = $output->results[0]->geometry->location->lat; 
        $data['longitude'] = $output->results[0]->geometry->location->lng;
        //Return latitude and longitude of the given address
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }else{
        return false;   
    }
  }
$data = json_decode(file_get_contents("php://input"));  
$username = $data->username;
$gender = $data->gender;
$bloodgroup = $data->bloodgroup;
$number = $data->number;
$weight = $data->weight;
$age = $data->age;
$city = $data->city;
$area = $data->area;
$email = $data->email;
$password = $data->password;
$conn = NEW mysqli("localhost","root","","bloodsystem");
 if($conn->connect_error){
     die("Connection failed");
 }
$passwordmd5=md5($password);
 $var1 = $data->area;
      $var2 = $data->city;
        $var3=$var1.$var2;
//        echo "$var3";
        $latLong = getLatLong($var3);
        $latitude = $latLong['latitude']?$latLong['latitude']:'Not found';
        $longitude = $latLong['longitude']?$latLong['longitude']:'Not found';
//          echo "$latitude";
//          echo "$longitude";
//        $created=date("Y-m-d H:i:s");
//        $modified=date("Y-m-d H:i:s");
 $sql = "INSERT INTO user (name,gender,age,weight,blood,email,phone,city,area,password,latitude,longitude) VALUES ('$username', '$gender', '$age', '$weight','$bloodgroup','$email','$number','$city','$area','$passwordmd5','$latitude','$longitude')";
 if($conn->query($sql) == TRUE) {
     echo "inserted succesfully";
 }
 else {
     echo "error ". $conn->error;
 }
  
 $conn->close();






?>

