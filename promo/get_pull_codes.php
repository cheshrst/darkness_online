<?php

$dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');

$pull_id=$_GET['pull_id'];

$sql="SELECT * FROM `promo_codes` WHERE `pull_id`='$pull_id'";
$result=mysqli_query($dbc, $sql);
$list=array();
$init=0;
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $list[$init]=array(
        'code_id'=>$row['id'],
        'activated_times'=>$row['activated_times'],
        'code'=>$row['code'],
        'bonuce_type'=>$row['bonuce_type'],
        'bonuce_sum'=>$row['bonuce_sum']
    );
    $init++;
}

$list['count']=$init;

echo json_encode($list);

?>