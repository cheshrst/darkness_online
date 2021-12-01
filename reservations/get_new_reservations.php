<?php
$dbc=mysqli_connect('localhost', 'id12867959_root_reserve', 'SDGO]/FNoYT#4P3^', 'id12867959_darkness_online_reserve');

$sql="SELECT * FROM `reservations` WHERE `status`='waitng'";

$result=mysqli_query($dbc, $sql);

?>