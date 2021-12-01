<?php

$pull_name=urldecode($_POST['pull_name']);
$date_from=$_POST['date_from'];
$date_to=$_POST['date_to'];
$activation_limit=$_POST['activation_limit'];
$status=$_POST['status'];

$dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');

$sql="SELECT * FROM `promo_puls` WHERE `name`='$pull_name'";
$result=mysqli_query($dbc, $sql);
if(mysqli_num_rows($result)!=0){
    header("HTTP/1.1 400 Bad request");
    exit();
}

if($activation_limit<1){
    header("HTTP/1.1 400 Bad request");
    exit();
}

$sql="INSERT INTO `promo_puls`(`name`, `activation_limit`, `date_from`, `date_to`, `status`) VALUES ('$pull_name','$activation_limit','$date_from','$date_to', '$status')";
mysqli_query($dbc, $sql);
header("HTTP/1.1 200 Success");
    exit();
?>