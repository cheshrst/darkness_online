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
      }else{
          $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
          $user_id=$row['user_id'];
          $computer_name=$_GET['computerName'];
          $computer_id=$_GET['id'];
      }
      
    ?>
    <div class="content_bookmark_1">
      <?php echo "<h2 class='ReserveComputerName' align='center'>$computer_name</h2>";?>
      <div class="reserveСalendar">
          <h2 class="pickDateTxt" align="center">Дата</h2>
          <select class="pickDateYear" id="pickDateYear"><option>2021</option></select>
          <select class="pickDateMonth" id="pickDateMonth"><option>11</option><option>12</option></select>
          <select class="pickDateDay" id="pickDateDay">
              <?php
              for($i=1; $i<=31; $i++){
                  echo "<option>$i</option>";
              }
              ?>
          </select>
      </div>
      <div class="reserveClock">
          <h2 class="pickDateTxt" align="center">Время</h2>
          <select class="pickHour" id="pickHour">
              <?php 
              for($i=0; $i<25; $i++){
                  if($i<10){
                      echo "<option>0$i</option>";
                  }else{
                      echo "<option>$i</option>";
                  }
              }
              ?>
          </select>
          <select class="pickMinutes" id="pickMinutes"><option>00</option><option>30</option></select>
      </div>
      <div class="reserve_service_button" id="logout_button" onclick="addReservation(<?php echo $computer_id; ?>)">
          <h3 class="logout_button_text" align="center">Забронировать</h3>
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
    }
  </style>
  
    <?php
        include "app_navigation.php";
    ?>
  </div>
  <script>
      function addReservation(computer_id){
          let year=document.getElementById('pickDateYear').value;
          let month=document.getElementById('pickDateMonth').value;
          let day=document.getElementById('pickDateDay').value;
          let timeHours=document.getElementById('pickHour').value;
          let timeMinutes=document.getElementById('pickMinutes').value;
          
          let date=year + "-"+ month +"-"+ day +"T"+ timeHours +":"+ timeMinutes +":00";
          
          var xhr = new XMLHttpRequest();

            xhr.open('GET', 'add_reservation_backend.php?host_id='+ computer_id +'&date_string=' + date, true);
            
            // 3. Отсылаем запрос
            xhr.send();
            
            xhr.onreadystatechange=function(){
                if (xhr.readyState==4){
                    if(xhr.responseText=="declined!"){
                        alert("Компьютер уже забронирован или недоступен!");
                    }
                    
                    if(xhr.responseText=="successfull!"){
                        alert("Бронь успешно добавлена!");
                    }
                }
            }
              
      }
  </script>
</body>
</html>
