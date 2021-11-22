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
    <div class="content_bookmark_1">
        <div class="payment_methods">
            <div class="payment_method"><h3 class="payment_text" align="center">Юкасса</h3></div>
            <div class="payment_method"><h3 class="payment_text" align="center">Qiwi</h3></div>
            <div class="payment_method"><h3 class="payment_text" align="center">Paypal</h3></div>
        </div>
        <input type="text" class="payment_amount" placeholder="Сумма" id="payment_amount">
        <div class="pay_button" onclick="deposit()"><h3 class="pay_button_text" align="center">Оплатить</h3></div>
    </div>
    <?php
        include "app_navigation.php";
    ?>
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
  <script src="script.js" type="text/javascript"></script>
</body>
</html>
