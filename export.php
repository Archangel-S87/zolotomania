<?php
   /*
   * Выгрузка bitrix
   * Mikhail Novikov
   * hello@catcod.ru
   * v.1.0 // 11.11.19
   */
	
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<?php header("Content-type:text/html; charset=utf-8");?>
 	<title>Импорт Базы</title>
   <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
   <style type="text/css">
      .button{
         padding: 10px 15px;
         text-align: center;
         text-decoration: none;
         box-sizing: border-box;
         line-height: 40px;
         color: #fff;
         border-radius: 3px;
         margin: 0 10px;
         font-size: 1rem;
         font-weight: 300;
      }
      .button--green{
         background: #8BC34A;
      }
      .button--red{
         background: red;
      }
      .header{
          text-align: center;
          border-bottom: 1px solid #ccc;
          box-shadow: 0 0 15px #ccc;
          position: fixed;
          width: 100%;
          top: 0;
          padding: 10px 0;
      }
      #main{
         display: block;
          border: 1px solid rgb(173, 195, 213);
          max-width: 80%;
          margin: 0 auto;
          margin-top: 100px;
          padding: 25px;
          border-radius: 3px;
      }
      body{
         padding: 0;
         margin:0;
         font-family: 'Montserrat', sans-serif;
      }
      .error{
          background: red;
          padding: 5px 10px;
          color: #fff;
          border-radius: 3px;
          margin-top: 15px;
      }
      .time{
         max-width: 80%;
          margin: 0 auto;
          margin-top: 25px;
          text-align: right;
      }
      hr{
         opacity: .3;
      }
      #log{
         height: 70vh;
         overflow-y: scroll;
      }
   </style>
 </head>
 <body>
   <header class="header">
      <a href="javascript:start('import.xml')" class="button button--green">импорт import.xml</a>
      <a href="javascript:start('offers.xml')" class="button button--green">импорт offers.xml</a>
      <a  href="javascript:reset()" class="button button--red">обнулить шаг</a>
      <a  href="javascript:status='stop'" class="button button--red">остановить импорт</a>
   </header>


<div id='main' style='display:none;'>
   <div id="log"></div>
   <div align=right id="load"></div>
</div>
<div id="timer"></div> 

<script type="text/javascript">
	var 
   log=document.getElementById("log");
   timer=document.getElementById("timer");
   load=document.getElementById("load");
   var zup_import=false;
   //переменные таймера
   m_second=0;
   seconds=0;
   minute=0;
   //переменные импорта
   i=1;
   a='';
   proccess=true;
   status="continue";


   function createHttpRequest() {
      var httpRequest;
         if (window.XMLHttpRequest) 
         httpRequest = new XMLHttpRequest();  
         else if (window.ActiveXObject) {    
         try {
         httpRequest = new ActiveXObject('Msxml2.XMLHTTP');  
         } catch (e){}                                   
         try {                                           
         httpRequest = new ActiveXObject('Microsoft.XMLHTTP');
         } catch (e){}
         }
      return httpRequest;

   }

   function start(file) {
         document.getElementById("main").style.display='block';
         load.innerHTML="<b>Загрузка</b>..."
                i=1;
         a="";
         m_second=0;
           seconds=0;
         proccess=true;
         start_timer();
         timer.innerHTML="";
         if (file=="company.xml") {zup_import=true;}
         log.innerHTML="<b>Импорт "+file+"</b><hr>";
         query_1c(file)
   }

   function query_1c(file) {
         var import_1c=createHttpRequest();
         if (zup_import==true)
         {
         r="/fivecms/cml/1c_exchange.php?type=catalog&mode=import&filename="+file;
         } else{r="/fivecms/cml/1c_exchange.php?type=catalog&mode=import&filename="+file;}
                        load.style.display="block";
               import_1c.open("GET", r, true);
         import_1c.onreadystatechange = function() 
               {
               a=log.innerHTML;
               if (import_1c.readyState == 4 && import_1c.status == 0)
                     {
                     error_text="<em>Ошибка в процессе выгрузки</em><div class='error'>Сервер упал и не вернул заголовков.</div>"
                        log.innerHTML=a+"Шаг "+i+": "+error_text;
                        load.style.display="none";
                        status="continue"
                        alert("Import is crashed!");
                     }
               
                     if (import_1c.readyState == 4 && import_1c.status == 200)  
                        {
                           if ((import_1c.responseText.substr(0,8 )!="progress")&&(import_1c.responseText.substr(0,7)!="success"))
                           {
                              error_text="<em>Ошибка в процессе выгрузки</em><div class='error'>"+import_1c.responseText+"</div>"
                              log.innerHTML=a+"Шаг "+i+": "+error_text;
                              status="error";
                           }
                           else
                           {
                              n=import_1c.responseText.lastIndexOf('s')+1;
                              l=import_1c.responseText.length;
                              mess=import_1c.responseText.substr(n,l);
                              log.innerHTML=a+"Шаг "+i+": "+mess+" ("+seconds+" сек.)"+"<br>";
                              seconds=0;
                              load.style.display="none";
                              i++;
                           }
                           if ((import_1c.responseText.substr(0,7)=="success")||(status=="error")||(status=="stop"))
                           {
                              load.style.display="none";
                              status="continue"
                              proccess=false;
                              timer.innerHTML="<div class='time'>Время выгрузки: <b>"+minute+" мин. "+m_second+" сек.</b></div>";
                           }
                           else 
                           { 
                              query_1c(file);
                           }
                        } 
                     
                     

               }; 
            import_1c.send(null);
   }

   function start_timer() {
            if (m_second==60)
            {
            m_second=0;
            minute+=1;
            }
            if (proccess==true)
            {
            seconds+=1;
            m_second+=1;

            setTimeout("start_timer()",1000);
         }
   }
      
   function reset() {
      var rest=createHttpRequest();
                  q="export.php";
                  rest.open("GET", q, true);
                  rest.onreadystatechange=function()
                           {
                           if (rest.readyState == 4 && rest.status == 200)  
                              alert("Шаг импорта обнулён!");
                           }
                  
                  rest.send(null);
                  
   }            
</script>
 </body>
 </html>

