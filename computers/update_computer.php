<?php
    $id=$_GET['id'];
    $status=$_GET['status'];
    $player_id=$_GET['player_id'];
    
    $dbc=mysqli_connect('localhost', 'id12867959_root_reserve', 'SDGO]/FNoYT#4P3^', 'id12867959_darkness_online_reserve');
    
    $sql="UPDATE `computers` SET `status`=$status, `player_id`=$player_id WHERE `id`=$id";
    mysqli_query($dbc, $sql);
?>