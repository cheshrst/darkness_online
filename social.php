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
      }else{
          $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
          $user_id=$row['user_id'];
      }
      
    ?>
    
    <!-- Вкладка контента номер 1 -->
    
    <div class="content_bookmark_1" id="content_bookmark_1">
      <input type="text" class="search_string" placeholder="Darkness ID" id="search_string">
        <div class="send_friend_request" onclick="send_friend_request()"><img class="button_image" src="src/add_icon.png"></div>
        <div class="fiend_list">
            <?php
                $sql="SELECT * FROM `friend_requests` WHERE `invited_id`='$user_id' AND `status`='waiting'";
                $result=mysqli_query($dbc, $sql);
                while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $inviter_id=$row['inviter_id'];
                    $request_id=$row['id'];
                    $sql="SELECT * FROM `users` WHERE `user_id`='$inviter_id'";
                    $row_two=mysqli_fetch_array(mysqli_query($dbc, $sql));
                    $inviter_nick=$row_two['login'];
                    echo "<div class=\"friend\"><h3 class=\"fiend_name\">$inviter_nick</h3><div class=\"accept_request_button\" onclick=\"accept_request($request_id)\"><img class=\"button_image\" src=\"src/add_icon.png\"></div></div>";
                }
                
                $sql="SELECT * FROM `users` WHERE `user_id`='$user_id'";
                $result=mysqli_query($dbc, $sql);
                $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
                $friends=explode(',', $row['friends']);
                $sql="SELECT * FROM `users` WHERE ";
                for ($i = 0; $i < count($friends)-1; $i++) {
                  $friend_id=$friends[$i];
                  $sql="SELECT * FROM `users` WHERE `user_id`='$friend_id'";
                  $row=mysqli_fetch_array(mysqli_query($dbc, $sql));
                  $friend_name=$row['login'];
                  echo "<div class=\"friend\"><h3 class=\"fiend_name\">$friend_name</h3></div>";
                }
            ?>
        </div>
    </div>
    
     <!-- Вкладка контента номер 2 -->
     
     <div class="content_bookmark_2" id="content_bookmark_2">
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
    
    <script>
        window.onload=function(){
            document.getElementById("bookmark1_text").innerText="Друзья";
            document.getElementById("bookmark2_text").innerText="Команды";
        }  
    </script>
    
    <?php
        include "app_navigation.php";
    ?>
  </div>
</body>
</html>
