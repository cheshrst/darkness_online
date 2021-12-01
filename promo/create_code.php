<?php

$dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');

$code=$_POST['code'];
$pull_name=$_POST['pull'];
$bonuce_type=$_POST['type'];
$bonuce_sum=$_POST['summ'];

$sql="SELECT * FROM `promo_puls` WHERE `name`='$pull_name'";
$result=mysqli_query($dbc, $sql);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$pull_id=$row['id'];

$sql="INSERT INTO `promo_codes`(`pull_id`, `activated_times`, `code`, `bonuce_type`, `bonuce_sum`) VALUES ('$pull_id','0','$code','$bonuce_type','$bonuce_sum')";
mysqli_query($dbc, $sql);
?>