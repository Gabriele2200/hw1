<?php
require_once "db.php";
if(isset($_GET["m"])){
   $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
   $userid = mysqli_real_escape_string($conn, $userid);
   $qSearchValue = mysqli_real_escape_string($conn,$_GET["m"]);
   $City_key = urlencode($qSearchValue);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://dataservice.accuweather.com/currentconditions/v1/'.$City_key.'?apikey=e4rUPcqdfSWTJIOZhAV8o7SitWbAB2FC',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo($response);

}