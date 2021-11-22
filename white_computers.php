<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="content">
    <?php
      include "header.php";
      $dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');
      $token=$_COOKIE['token'];
      $sql="SELECT * FROM `tokens` WHERE `token`='$token'";
      $result=mysqli_query($dbc, $sql);
      if(mysqli_num_rows($result)==0){
        echo "<script>document.location='http://escdarkness.ru/app/login.php'</script>";
      }
    ?>
    <div class="main_menu_computers">
      <?php
        
        
        //computer updater
      
      
      $computer_list=array();
      for ($i=0; $i<=54; $i++){
          $computer_list[$i]=array(
              'status'=>0,
              'userId'=>0
              );
      }
      
        $ch = curl_init("http://5.228.174.10/api/usersessions/active");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_USERPWD, "darkness_app:darkness2021");
        $json = curl_exec($ch);
        curl_close($ch);
        
        $computer_data=json_decode($json);
        
        $sessions=array();
        $i=0;
        
       $computer_data=$computer_data->result;
        
        
        foreach ($computer_data as $row) {
            $sessions[$i]=array();
            $sessions[$i]['hostId']=$row->hostId;
            $sessions[$i]['userId']=$row->userId;
            $i++;
        }
        
        foreach ($sessions as $s) {
           // echo $s['hostId'];
            $computer_list[$s['hostId']]['status']=1;
            $computer_list[$s['hostId']]['userId']=$s['userId'];
           
        }
        
        
        for($i=5; $i<=54; $i++){
            
            $sql="UPDATE `computers` SET `status`=".$computer_list[$i]['status'].", `player_id`=".$computer_list[$i]['userId']." WHERE `id`=$i";
            mysqli_query($dbc, $sql);
            
        }
        
      //computer updater
        
         
        $sql="SELECT * FROM `computers` WHERE `room`='whiteroom' ORDER BY `name` ASC";
        $result=mysqli_query($dbc, $sql);
        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $computer_id=$row['id'];
            $computer_name=$row['name'];
            $computer_status=$row['status'];
            if($computer_status==0){
                $text_class="computer_gaming_text";
            }else{
                $text_class="computer_gaming_text_playing";
            }
            echo "<div class=\"computer_gaming\">
              <h2 class=\"$text_class\">$computer_name</h2>
              <div class=\"logIntoAccButton\" onclick=\"enable_pc($computer_id)\"><img class=\"button_image\" src=\"src/login.png\"></div>
              <div class=\"reserve_button\" onclick=\"document.location='reserve.php?id=$computer_id&computerName=$computer_name'\"><img class=\"button_image\" src=\"src/reserve_icon.png\"></div>
            </div>";
        }
      ?>
      
    </div>
  </div>
  <script src="script.js" type="text/javascript"></script>
</body>
</html>
