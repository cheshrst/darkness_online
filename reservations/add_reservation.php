<?php

$reservator_id=$_POST['reservator_id'];
$computer_id=$_POST['computer_id'];
$time=$_POST['time'];

$dbc=mysqli_connect('localhost', 'id12867959_root_reserve', 'SDGO]/FNoYT#4P3^', 'id12867959_darkness_online_reserve');

$sql="INSERT INTO `reservations`(`reservator_id`, `computer_id`, `time`, `status`) VALUES ('$reservator_id','$computer_id','$time','waiting')";
?>