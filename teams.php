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
        echo "<script>document.location='http://escdarkness.ru/app/login.php'</script>";
      }
      $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
      $user_id=$row['user_id'];
    ?>
    
    <div class="main_menu_computers">
        <input type="text" class="search_string" placeholder="Название" id="search_string">
        <div class="send_friend_request" onclick="send_friend_request()"><img class="button_image" src="src/search_icon.png"></div>
        <div class="teams_list">
            <?php
                $sql="SELECT * FROM `team_invites` WHERE `user_id`='$user_id' AND `status`='0'";
                $result=mysqli_query($dbc, $sql);
                while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $team_id=$row['team_id'];
                    $invite_id=$row['id'];
                    $sql_request="SELECT * FROM `teams` WHERE `id`='$team_id'";
                    $result_second=mysqli_query($dbc, $sql_request);
                    $row_two=mysqli_fetch_array($result_second, MYSQLI_ASSOC);
                    $team_name=$row_two['name'];
                    echo "<div class=\"friend\" onclick=\"document.location='http://escdarkness.ru/app/team.php?id=$team_id'\"><h3 class=\"fiend_name\">$team_name</h3><div class=\"logIntoAccButton\" onclick=\"accept_invite($invite_id)\"></div></div>";
                }
                
                $sql="SELECT * FROM `teams` ORDER BY `raiting` DESC";
                $result=mysqli_query($dbc, $sql);
                while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $team_id=$row['id'];
                    $team_name=$row['name'];
                    echo "<div class=\"friend\" onclick=\"document.location='http://escdarkness.ru/app/team.php?id=$team_id'\"><h3 class=\"fiend_name\">$team_name</h3></div>";
                }
            ?>
        </div>
        <div class="create_team" id="create_team">
          <h3 class="create_team_text" align="center">Создать</h3>
        </div>
         <div class="tournaments_button" id="tournaments_button">
          <h3 class="tournaments_button_text" align="center">Турниры</h3>
        </div>
        <script>
            document.getElementById('create_team').onclick=function(){
                document.location="create_team.php";
            };
            document.getElementById('tournaments_button').onclick=function(){
                document.location="top_up.php";
            };
        </script>
    </div>
        
    </div>
  </div>
</body>
</html>
