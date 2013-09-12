<?php 
session_start();
$names = $_POST["name"];
$works = $_POST["work"];
$_SESSION["name"] = $names;
$_SESSION["work"] = $works;
if($names){
$data = array(
		'name' => $_SESSION["name"],
		'work' => $_SESSION["work"]
	);
echo json_encode($data);
}else{
echo 'failure';
} ?>