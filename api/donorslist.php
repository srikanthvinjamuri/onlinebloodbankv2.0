
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
  
  
function GetDrivingDistance($lat1, $long1, $lat2, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

    return array('distance' => $dist, 'time' => $time);
}
$data = json_decode(file_get_contents("php://input"));
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";
$conn = new mysqli($servername, $username, $password, $dbname);
$seekarea = $data->area;
$blood=$data->blood;

//echo '<script>console.log('.$seekarea.')</script>';
//        echo "$var3";
        $latLong = getLatLong($seekarea);
//        echo '<script>console.log('.$latLong.')</script>';
        $latitude = $latLong['latitude']?$latLong['latitude']:'Not found';
        $longitude = $latLong['longitude']?$latLong['longitude']:'Not found';
        $x=$longitude+0.3000;
        $y=$longitude-0.3000;
//echo '<script>console.log('.$city.')</script>';
                  $truncate="truncate table temp";
          if($conn->query($truncate) == TRUE) {
                //echo "Truncated succesfully";
                
            }
            else {
                echo "error ". $conn->error;
            }
        $sql1="SELECT name,blood,phone,email,area,latitude,longitude FROM user where longitude between $y and $x and blood='$blood'";

        if ($result=mysqli_query($conn,$sql1))
          {
          // Fetch one and one row
          while ($row=mysqli_fetch_row($result))
            {
              $x1=$row[5];
//              echo '<script>console.log('.$x1.')</script>';
              $x2=$row[6];
//              echo '<script>console.log('.$x2.')</script>';
              $dist=GetDrivingDistance($latitude,$longitude,$x1,$x2);
              $distance=$dist['distance'];
              $sql_query="insert into temp values ('$row[0]','$row[1]','$row[3]','$row[4]','$distance','$row[2]')";
              
              if($conn->query($sql_query) == TRUE) {
//                echo "inserted succesfully";
            }
            else {
                echo "error ". $conn->error;
            }
             }
          // Free result set
          mysqli_free_result($result);
//          $truncate="truncate table temp";
//          if($conn->query($truncate) == TRUE) {
//                echo "Truncated succesfully";
//            }
//            else {
//                echo "error ". $conn->error;
//            }
        }
        
        
        
        
$sql = "SELECT *FROM temp order by distance";
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

