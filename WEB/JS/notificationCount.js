 
 function getNotificationCount() 
 {
 var count = document.getElementById('count') ; 
  var xhr = new XMLHttpRequest() ; 
    xhr.open('get' , '../config/notificationCount.php' , true) ;

    xhr.onreadystatechange = function () 
    {
        if (xhr.readyState === 4 && xhr.status === 200) 
        {
           var data = JSON.parse(xhr.responseText) ; 

           count.textContent = String(data) ;

           if (data === 0) 
           {
               count.hidden = true ;
           }
           
            
        }
      
    }
    xhr.send() ;
}

 function getMessageCount()
 {
     var count = document.getElementById('messageCount') ;
     var xhr = new XMLHttpRequest() ;
     xhr.open('get' , '../config/newMessage.php' , true) ;

     xhr.onreadystatechange = function ()
     {
         if (xhr.readyState === 4 && xhr.status === 200)
         {
             var data = JSON.parse(xhr.responseText) ;

             count.innerHTML = Number(data) ;

             if (data === 0)
             {
                 count.hidden = true ;
             }


         }

     }
     xhr.send() ;
 }
getNotificationCount() ; 
getMessageCount() ;
