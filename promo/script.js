var last_data="";
var searching=false;

function openWindow(window){
    switch(window){
        case 'createPull':
            document.getElementById('create_pull_window').style.display="block";
        break;
        case 'mainPulls':
             document.getElementById('create_pull_window').style.display="none";
        break;
    }
}

function create_new_pull(){
    let pull_name=document.getElementById('pull_name').value;
    
    let date_from_year=document.getElementById('pickDateYear').value;
    let date_from_month=document.getElementById('pickDateMonth').value;
    let date_from_day=document.getElementById('pickDateDay').value;
    
    let date_to_year=document.getElementById('pickDateYearSec').value;
    let date_to_month=document.getElementById('pickDateMonthSec').value;
    let date_to_day=document.getElementById('pickDateDaySec').value;
    
    let activation_limit=document.getElementById('activation_limit').value;
    let disabled=document.getElementById('disabled').checked;
    
    let date_from=""+date_from_year+"."+date_from_month+"."+date_from_day;
    let date_to=""+ date_to_year +"."+ date_to_month +"."+ date_to_day;
    
    if(disabled){
        disabled=1;
    }else{
        disabled=0;
    }
    
    let xhr=new XMLHttpRequest();
      let adress="create_pull.php";
      xhr.open('POST', adress, true);
      let params="pull_name=" + encodeURIComponent(pull_name)+ "&date_from=" + encodeURIComponent(date_from) +"&date_to="+ encodeURIComponent(date_to)+"&activation_limit="+encodeURIComponent(activation_limit)+"&status="+encodeURIComponent(disabled);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(encodeURI(params));
      xhr.onreadystatechange=function(){
        console.log(xhr);
        if(xhr.readyState==4){
          if (xhr.status!=200){
            alert("Ошибка создания!");
          }else{
            openWindow("mainPulls");
          }
        }
      }
}

function update_list(){
    if(!searching){
     let xhr=new XMLHttpRequest();
      let adress="get_pull_list.php";
      xhr.open('GET', adress, true);
      xhr.send();
      xhr.onreadystatechange=function(){
        if(xhr.readyState==4){
          if (xhr.status!=200){
            console.log("Ошибка!");
          }else{
            if(xhr.responseText!=last_data){
              let elems_code="";
                let result=JSON.parse(xhr.responseText);
                for(let i=0; i<result.count; i++){
                    
                    let status=result[i].status;
                        if (status==1){
                            status="checked";
                        }else{
                            status="";
                        }
                        let this_elem_code="<div class=\"pull_list_element\" onclick=\"updateCodes("+ result[i].pull_id +")\"><h2 class=\"pull_list_element_name\">"+ result[i].pull_name +"</h2><p class=\"pull_list_element_from\">Дейтвителен от: "+ result[i].date_from +"</p><p class=\"pull_list_element_to\">Дейтвителен до: "+ result[i].date_to +"</p><p class=\"pull_list_element_checkbox_text\">Отключён:<input type=\"checkbox\""+ status +" onchange='updateStatus("+ result[i].pull_id +")' id='pull_status_"+ result[i].pull_id +"' class=\"pull_list_element_checkbox\"></p><p class=\"pull_list_activation_limit\">Лимит активаций: "+ result[i].activation_limit +"</p></div>";
                        elems_code=elems_code+this_elem_code;
                }
                document.getElementById('pul_list').innerHTML=elems_code;  
                last_data=xhr.responseText;
            }
          }
        }
      }
    }
}

function search_pulls(){
    let request=document.getElementById('search_string').value;
    if (request.length>0){
        searching=true;
        let xhr=new XMLHttpRequest();
          let adress="get_pull_list_request.php?request="+request;
          xhr.open('GET', adress, true);
          xhr.send();
          xhr.onreadystatechange=function(){
            if(xhr.readyState==4){
              if (xhr.status!=200){
                console.log("Ошибка!");
              }else{
                if(xhr.responseText!=last_data){
                  let elems_code="";
                    let result=JSON.parse(xhr.responseText);
                    for(let i=0; i<result.count; i++){
                        let status=result[i].status;
                        if (status==1){
                            status="checked";
                        }else{
                            status="";
                        }
                        let this_elem_code="<div class=\"pull_list_element\" onclick=\"updateCodes("+ result[i].pull_id +")\"><h2 class=\"pull_list_element_name\">"+ result[i].pull_name +"</h2><p class=\"pull_list_element_from\">Дейтвителен от: "+ result[i].date_from +"</p><p class=\"pull_list_element_to\">Дейтвителен до: "+ result[i].date_to +"</p><p class=\"pull_list_element_checkbox_text\">Отключён:<input type=\"checkbox\""+ status +" onchange='updateStatus("+ result[i].pull_id +")' id='pull_status_"+ result[i].pull_id +"' class=\"pull_list_element_checkbox\"></p><p class=\"pull_list_activation_limit\">Лимит активаций: "+ result[i].activation_limit +"</p></div>";
                        elems_code=elems_code+this_elem_code;
                    }
                    document.getElementById('pul_list').innerHTML=elems_code; 
                }
              }
            }
          }
    }else{
        searching=false;
        last_data="";
    }
}


function updateCodes(pull_id){
    
    let xhr=new XMLHttpRequest();
    let adress="get_pull_codes.php?pull_id="+pull_id;
    console.log(adress);
      xhr.open('GET', adress, true);
      xhr.send();
      xhr.onreadystatechange=function(){
        console.log(xhr);
        if(xhr.readyState==4){
          if (xhr.status!=200){
            alert("Ошибка!");
          }else{
            let elems_code="";
                    let result=JSON.parse(xhr.responseText);
                    for(let i=0; i<result.count; i++){
                        if(result[i].bonuce_type==1){
                            type="На депозит";
                        }else{
                            type="Баллами";
                        }
                        
                        let this_elem_code="<div class=\"codes_list_element\" onclick=\"showCodeData("+ result[i].code_id +")\"><p class=\"code_list_elenent_code\">"+ result[i].code +"</p><p class=\"code_list_element_bonuce_type\">"+ type +"</p><p class=\"code_list_element_bonuce_sum\">"+ result[i].bonuce_sum +"</p><p class=\"code_list_element_activated_times\">"+ result[i].activated_times +"</p></div>";
                        elems_code=elems_code+this_elem_code;
                    }
                    document.getElementById('codes_list').innerHTML=elems_code;
          }
        }
      }
}

function createCode(){
    let code=document.getElementById('code_list_create_code').value;
    let pull_name=document.getElementById('code_list_create_pull').value;
    let type=document.getElementById('code_list_create_bonuce_type').value;
    let summ=document.getElementById('code_list_create_summ').value;
    
    if (type=="На депозит"){
        type=1;
    }else{
        type=2;
    }
    
    let xhr=new XMLHttpRequest();
    let adress="create_code.php";
      xhr.open('POST', adress, true);
      let params="code=" + code+ "&pull=" + pull_name +"&type="+ type+"&summ="+summ;
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(encodeURI(params));
      xhr.onreadystatechange=function(){
        console.log(xhr);
        if(xhr.readyState==4){
          if (xhr.status!=200){
            alert("Ошибка создания!");
          }else{
            alert("Создано!");
          }
        }
      }
}

function updateStatus(pull_id){
    let status=document.getElementById('pull_status_'+pull_id).checked;
    if (status){
        status=1;
    }else{
        status=0;
    }
    
     let xhr=new XMLHttpRequest();
    let adress="update_pull_status.php";
      xhr.open('POST', adress, true);
      let params="pull_id=" + pull_id+ "&status=" + status;
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(encodeURI(params));
}