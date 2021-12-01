<?php
$token=$_GET['token'];
$invited_login=$_GET['invited_login'];

$dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');

$sql="SELECT * FROM `tokens` WHERE `token`='$token'";
$result=mysqli_query($dbc, $sql);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$inviter_id=$row['user_id'];

$sql="SELECT * FROM `users` WHERE `login`='$invited_login'";
$result=mysqli_query($dbc, $sql);
if(mysqli_num_rows($result)==0){
    echo "error";
    exit();
}
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$invited_id=$row['user_id'];

$sql="INSERT INTO `friend_requests`(`inviter_id`, `invited_id`, `status`) VALUES ('$inviter_id','$invited_id','waiting')";
mysqli_query($dbc, $sql);

?>