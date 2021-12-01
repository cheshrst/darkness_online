<?php
    
    $id=$_GET['id'];
    $name=$_GET['name'];
    $group=$_GET['group'];

    $dbc=mysqli_connect('localhost', 'id12867959_root_reserve', 'SDGO]/FNoYT#4P3^', 'id12867959_darkness_online_reserve');
    
    $sql="INSERT INTO `computers`(`id`, `name`, `status`, `room`) VALUES ($id,'$name',0,'$group')";
    mysqli_query($dbc, $sql);
?>