<?php
$request_id=$_GET['requset_id'];

$dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');

$sql="SELECT * FROM `friend_requests` WHERE `id`='$request_id'";
$result=mysqli_query($dbc, $sql);
if(mysqli_num_rows($result)==0){
    echo "error";
    exit();
}
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);

$inviter_id=$row['inviter_id'];
$invited_id=$row['invited_id'];

$sql="SELECT * FROM `users` WHERE `user_id`='$inviter_id'";
$result=mysqli_query($dbc, $sql);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_friends=$row['friends'];
$user_friends.="$invited_id,";
$sql="UPDATE `users` SET `friends`='$user_friends' WHERE `user_id`='$inviter_id'";
mysqli_query($dbc, $sql);

$sql="SELECT * FROM `users` WHERE `user_id`='$invited_id'";
$result=mysqli_query($dbc, $sql);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_friends=$row['friends'];
$user_friends.="$inviter_id,";
$sql="UPDATE `users` SET `friends`='$user_friends' WHERE `user_id`='$invited_id'";
mysqli_query($dbc, $sql);

$sql="UPDATE `friend_requests` SET `status`='accepted' WHERE `id`='$request_id'";
mysqli_query($dbc, $sql);

?>