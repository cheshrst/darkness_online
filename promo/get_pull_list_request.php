<?php

$dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');

$request=$_GET['request'];

$sql="SELECT * FROM `promo_puls` WHERE LOCATE('$request', `name`)";
$result=mysqli_query($dbc, $sql);
$list=array();
$init=0;
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $list[$init]=array(
        'pull_id'=>$row['id'],
        'pull_name'=>$row['name'],
        'activation_limit'=>$row['activation_limit'],
        'date_from'=>$row['date_from'],
        'date_to'=>$row['date_to'],
        'status'=>$row['status']
    );
    $init++;
}

$list['count']=$init;

echo json_encode($list);

?>