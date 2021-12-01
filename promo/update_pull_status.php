<?php

$dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');

$pull_id=$_POST['pull_id'];
$pull_status=$_POST['status'];

$sql="UPDATE `promo_puls` SET `status`='$pull_status' WHERE `id`='$pull_id'";
mysqli_query($dbc, $sql);

?>