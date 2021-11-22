<?php


$user_login=urlencode($_GET['user_login']);
$user_password=urlencode($_GET['user_password']);
$user_email=urlencode($_GET['user_email']);
$user_name=urlencode($_GET['user_name']);

$ch = curl_init("http://5.228.174.10/api/users?username=$user_login&usergroupid=1&email=$user_email&firstname=$user_name");
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERPWD, "darkness_app:darkness2021");
$json=curl_exec($ch);
curl_close($ch);

echo $json;
echo '---------';

$ch = curl_init("http://5.228.174.10/api/users/$user_login/username");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERPWD, "darkness_app:darkness2021");
$json=json_decode(curl_exec($ch));
curl_close($ch);

sleep(0.5);

$user_id=$json->result->id;

$ch = curl_init("http://5.228.174.10/api/users/$user_id/password/$user_password");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERPWD, "darkness_app:darkness2021");
curl_exec($ch);
curl_close($ch);
echo("ok!");
?>