<?php 
session_start();
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$_SESSION['lat'] = $lat;
$_SESSION['lng'] = $lng;
if($lat){
echo $lat; 
}else{
echo 'failure';
} ?>