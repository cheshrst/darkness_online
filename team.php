<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
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
        echo "<script>document.location='https://escdarkness.ru/app/login.php'</script>";
      }
      $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
      $user_id=$row['user_id'];
      
      $team_id=$_GET['id'];
      
      $sql="SELECT * FROM `teams` WHERE `id`='$team_id'";
      $result=mysqli_query($dbc, $sql);
      $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
      $team_name=$row['name'];
      $team_tag=$row['tag'];
      $team_raiting=$row['raiting'];
      $team_devis=$row['devis'];
      $team_owner=$row['owner_id'];
    ?>
    <div class="content_bookmark_1">
        <div class="stats">
        <div class="stats_balance">
          <h3 class="stats_text">Название</h3>
          <h3 class="stats_text_value"><?php echo $team_name?></h3>
        </div>
        <div class="stats_points">
          <h3 class="stats_text">Тэг</h3>
          <h3 class="stats_text_value"><?php echo $team_tag?></h3>
        </div>
        <div class="stats_playedTime">
          <h3 class="stats_text">Рейтинг</h3>
          <h3 class="stats_text_value"><?php echo $team_raiting?></h3>
        </div>
        <div class="stats_lastActive">
          <h3 class="stats_text">Девиз</h3>
          <h3 class="stats_text_value"><?php echo $team_devis ?></h3>
        </div>
      </div>
        <div class="team_player_list">
            <?php
                $sql="SELECT * FROM `users` WHERE `team_id`='$team_id'";
                $result=mysqli_query($dbc, $sql);
                while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $player_name=$row['login'];
                    echo "<div class=\"team_player\">
                       <h2 class=\"team_player_name\">$player_name</h2>
                   </div> ";
                }
                if(mysqli_num_rows($result)<5 && $team_owner==$user_id){
                    echo "<div class=\"team_player\" onclick=\"document.location='invite_to_team.php'\">
                       <h2 class=\"team_player_name\">Пригласить игрока</h2>
                   </div> ";
                }
            ?>
        </div>
      </div>
    </div>
    <style>
    @media (max-device-width: 799px){
        header{
           display:none;
        }
        
        .content_bookmark_1{
            margin-top:-10%;
        }
    }
    
    @media (min-device-width: 799px){
        header{
           display:none;
        }
        
        .content_bookmark_1{
            width:100%;
        }
        
        .stats{
            left:5%;
        }
    }
  </style>
    <?php
        include "app_navigation.php";
    ?>
  </div>
</body>
</html>
