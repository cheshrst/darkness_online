function get_cookie(cookie_name){
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}

function auth(){
  let user_login=document.getElementById("user_login").value;
  let user_password=document.getElementById("user_password").value;
  let user_invite=document.getElementById("user_invite").value;
  let xhr=new XMLHttpRequest();
  let adress="auth.php";
  xhr.open('POST', adress, true);
  let params="login=" + encodeURIComponent(user_login)+ "&password=" + encodeURIComponent(user_password) +"&code="+ encodeURIComponent(user_invite);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(encodeURI(params));
  xhr.onreadystatechange=function(){
    console.log(xhr);
    if(xhr.readyState==4){
      if (xhr.status!=202){
        alert(xhr.status);
      }else{
        document.cookie = "token="+xhr.response;
        document.location="index.php";
      }
    }
  }
}

function logout(){
    let user_token=get_cookie('token');
    let xhr=new XMLHttpRequest();
    let adress="logout.php?token="+user_token;
    xhr.open('GET', adress, true);
    xhr.send();
    document.cookie="token=000000";
    location.reload();
}

function enable_pc(id){
    let user_token=get_cookie('token');
    let pc_id=id;
    let xhr=new XMLHttpRequest();
    let adress="http://escdarkness.ru/app/enable_pc.php?token="+user_token+"&computer_id="+pc_id;
    xhr.open('GET', adress, true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4){
            if(xhr.responseText=="already logginned!"){
                alert("Вы уже в системе!");
            }
            
            if(xhr.responseText=="unaviable!"){
                alert("Компьютер уже занят или не доступен!");
            }
            
            if(xhr.responseText=="Successfull!"){
                alert("Вы успешно вошли!");
            }
            
            if(xhr.responseText=="undefinded error!"){
                alert("Неизвестная ошибка!");
            }
        }
    }
}

function deposit(){
    let user_token=get_cookie('token');
    let amount=document.getElementById('payment_amount').value;
    let xhr=new XMLHttpRequest();
    let adress="http://escdarkness.ru/app/deposit.php?token="+user_token+"&amount="+amount;
    xhr.open('GET', adress, true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4){
            document.location="index.php";
        }
    }
}

function send_friend_request(){
    let user_token=get_cookie('token');
    let user_login=document.getElementById('search_string').value;
    let xhr=new XMLHttpRequest();
    let adress="http://escdarkness.ru/app/friends/send_request.php?token="+user_token+"&invited_login="+user_login;
    xhr.open('GET', adress, true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4){
            if(xhr.responseText!='error'){
                alert('Запрос успешно отправлен!');
            }else{
                alert('Пользователь не найден!');
            }
        }
    }
}

function accept_request(request_id){
    let xhr=new XMLHttpRequest();
    let adress="http://escdarkness.ru/app/friends/accept_request.php?requset_id="+request_id;
    xhr.open('GET', adress, true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4){
            if(xhr.responseText!='error'){
                alert('Запрос успешно принят!');
            }else{
                alert('Запроса не существует!');
            }
        }
    }
}

function invite_to_team(user_id){
    let xhr=new XMLHttpRequest();
    let adress="http://escdarkness.ru/app/invite_to_team_backend.php?user_id="+user_id;
    xhr.open('GET', adress, true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4){
            if(xhr.responseText!='error'){
                alert('Запрос успешно принят!');
            }else{
                alert('Запроса не существует!');
            }
        }
    }
}

function accept_invite(invite_id){
     let xhr=new XMLHttpRequest();
    let adress="http://escdarkness.ru/app/invite_to_team_accept_backend.php?invite_id="+invite_id;
    xhr.open('GET', adress, true);
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4){
            if(xhr.responseText!='error'){
                alert('Запрос успешно принят!');
            }else{
                alert('Запроса не существует!');
            }
        }
    }
}

function openBookmark(mark){
    let selected=1;
    let not_selected=1;
    switch(mark){
        case 1:
            selected=1;
            not_selected=2;
        break;
        case 2:
            selected=2;
            not_selected=1;
        break;
    }
    document.getElementById("content_bookmark_"+selected).style.display="block";
    document.getElementById("content_bookmark_"+not_selected).style.display="none";
    document.getElementById("bookmark"+selected).style.background="rgba(0, 0, 0, 0.35)";
    document.getElementById("bookmark"+not_selected).style.background="rgba(0, 0, 0, 0.75)";
}