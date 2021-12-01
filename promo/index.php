<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=0.4"> -->
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <div class="content">
    <?php
      $dbc=mysqli_connect('esc1162203.mysql', 'esc1162203_mysql', 'sC:a2sEi', 'esc1162203_db', '3306');
      $token=$_COOKIE['token'];
      $sql="SELECT * FROM `tokens` WHERE `token`='$token'";
      $result=mysqli_query($dbc, $sql);
      if(mysqli_num_rows($result)==0){
        echo "<script>document.location='http://escdarkness.ru/app/login.php'</script>";
      }else{
          $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
          $user_id=$row['user_id'];
          $sql="SELECT * FROM `users` WHERE `user_id`='$user_id'";
          $result=mysqli_query($dbc, $sql);
          $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
          $user_role=$row['role'];
          if($user_role==0){
              echo "<h2 class='errorMessage'>У вас недостаточно прав!</h>";
              exit();
          }
      }
          
        ?>
        <div class="promocodes_puls">
            <input type="text" placeholder="Искать пул" class="puls_search" onInput="search_pulls()" id="search_string">
            <div class="create_new_pull_button" onclick="openWindow('createPull')"></div>
            <div class="pul_list" id="pul_list">
            </div>
            <div class="create_pull_window" id="create_pull_window">
                <div class="create_pull_window_back_button" onclick="openWindow('mainPulls')">
                    <h2 class="create_pull_window_back_button_text" align="center">Назад</h2>
                </div>
                <input type="text" class="create_pull_window_name" placeholder="Название пула" id="pull_name">
                <div class="create_pull_window_from_date">
                    <h2 class="pickDateTxt" align="center">от</h2>
                      <select class="pickDateYear" id="pickDateYear"><option>2021</option><option>2022</option></select>
                      <select class="pickDateMonth" id="pickDateMonth">
                       <?php
                          for($i=1; $i<=12; $i++){
                              echo "<option>$i</option>";
                          }
                        ?>
                      </select>
                      <select class="pickDateDay" id="pickDateDay">
                          <?php
                          for($i=1; $i<=31; $i++){
                              echo "<option>$i</option>";
                          }
                          ?>
                      </select>
                </div>
                <div class="create_pull_window_to_date">
                    <h2 class="pickDateTxt" align="center">до</h2>
                      <select class="pickDateYear" id="pickDateYearSec"><option>2021</option><option>2022</option></select>
                      <select class="pickDateMonth" id="pickDateMonthSec">
                       <?php
                          for($i=1; $i<=12; $i++){
                              echo "<option>$i</option>";
                          }
                        ?>
                      </select>
                      <select class="pickDateDay" id="pickDateDaySec">
                          <?php
                          for($i=1; $i<=31; $i++){
                              echo "<option>$i</option>";
                          }
                          ?>
                      </select>
                </div>
                <div class="create_pull_window_access_settings">
                    <input type="text" class="create_pull_window_access_activation_limit" id="activation_limit" placeholder="Лимит">
                    <p class="create_pull_window_access_status_text">Отключён</p><input type="checkbox" id="disabled" class="create_pull_window_access_status">
                </div>
                <div class="create_pull_window_button_create" onclick="create_new_pull()">
                    <h2 class="create_pull_window_button_create_text" align="center">Создать</h2>
                </div>
            </div>
        </div>
        <div class="promocodes_list">
            <input type="text" placeholder="Искать код" class="codes_search">
            <!--<div class="create_new_code_button" onclick="openWindow('createCode')"></div>-->
            <div class="codes_list">
                <div class="codes_list_element">
                    <input type="text" placeholder="код" class="code_list_create_code" id="code_list_create_code">
                    <select class="code_list_create_pull" id="code_list_create_pull">
                        <?php
                        $sql="SELECT * FROM `promo_puls`";
                        $result=mysqli_query($dbc, $sql);
                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            $pull_name=$row['name'];
                            echo "<option>$pull_name</option>";
                        }
                        ?>
                    </select>
                    <select class="code_list_create_bonuce_type" id="code_list_create_bonuce_type">
                        <option>На депозит</option>
                        <option>Баллами</option>
                    </select>
                    <input type="text" placeholder="сумма" class="code_list_create_summ" id="code_list_create_summ">
                    <div class="code_list_create_button" onclick="createCode()"></div>
                </div>
                <div class="codes_list_sec" id="codes_list"></div>
            </div>
        </div>
  </div>
  <script>
      setInterval(update_list, 1000);
  </script>
</body>
</html>
