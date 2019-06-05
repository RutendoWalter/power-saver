var list_all="";

       
function shake(id){
 id="#"+id;
    $(id).effect("shake");
   setTimeout(function(){
    poplogin();   
   },1000);
  
}
function open_doors(){
 $("#two").animate({left:"0%"},2000);   
    $("#three").animate({left:"75%"},2000);
 setTimeout(function() {
  $("#two").animate({left:"-25%"},2000);   
         $("#one").animate({left:"-25%"},2000);
         $("#three").animate({left:"125%"},2000);
        $("#four").animate({left:"125%"},2000);  
  }, 3000);
     
   
}
function poplogin(){
    
   $(".login").css({visibility:"visible"});
    
}
function closelogin(){
    
    $(".login").css({visibility:"collapse"}); 
}
$("#password").keypress(function(event){
    var keycode = event.keyCode;
    if(keycode == '13'){
   $.get("main.php",{password:$("#password").val()},function(data){
    if(data==="true"){
        open_doors();
        closelogin();
        setTimeout(function(){
           $(".configure_menu").css({visibility:"visible"});
        $(".configure").css({visibility:"visible"});  
          $(".graphs").css({visibility:"visible"});  
        },5000);
      
    }
       
   });     
    }
});
function choose(str){
   if(str==="normal"){
    $("#normal").css({borderLeft:"3px solid grey"});  
     $("#powersave").css({borderLeft:"none"});
        $("#strict").css({borderLeft:"none"});
        //send to server as normal
       set_mode("normal");
   }else if(str==="powersave"){
       
     $("#powersave").css({borderLeft:"3px solid grey"});   
       $("#normal").css({borderLeft:"none"});
        $("#strict").css({borderLeft:"none"});
        //send to server as powersave
        set_mode("powersaver");
   }else if(str==="strict"){
        $("#strict").css({borderLeft:"3px solid grey"});
          $("#powersave").css({borderLeft:"none"});
        $("#normal").css({borderLeft:"none"});
       //send to server as strict
       set_mode("strict");
   } 
    
}
function set_mode(str){
   $.get("main.php",{mode:str},function(data){
   if(data!=="error"){
 
   } else{
       notify("error");
   } 
            
        });  
}
function add_tolist(){
  var from=$("#from").val();  
   var to=$("#to").val();

   list_all=list_all+"||"+from+"[]"+to;
   
  $("#times").append("<table>"+"<tr><td><input value='"+from+"' type='button' class='input' /></td>"+
                               " <td><input value='"+to+"' type='button' class='input' /></td></tr>"+  
                            "</table>");
}
function enter_mode(str){
   
   list_all=str;
   
   $(".backboard").css({visibility:"visible"});
   $(".enter_times").css({visibility:"visible"});
   document.getElementById("eee").innerHTML=" <table class='times' id='times' style='z-index: 10;'  >"+
                               " <thead><th>FROM</th>"+
                            "<th>TO</th><th></th>"+
                            "</thead>"+
                            "<tr><td><input id='from' value='00:00' type='text' class='input' /></td>"+
                                "<td><input id='to' value='00:00' type='text' class='input' /></td>"+
                               " <td><input onclick='add_tolist()' value='GO' type='button' class='input' /></td></tr>"+
                            "</table>   ";
   
}
function notify(str){
 $(".backboard").css({visibility:"visible"});
 $(".notifications").css({visibility:"visible"});
  $(".enter_times").css({visibility:"collapse"});
 document.getElementById("noti").innerHTML=str; 
 list_all="";
}
function send_close(){
    $(".backboard").css({visibility:"collapse"});
   $(".enter_times").css({visibility:"collapse"});
   $(".notifications").css({visibility:"collapse"});

   if(list_all!==""){
   $.get("main.php",{enter_schedule:list_all},function(data){
      notify(data); 
       
   }); 
   }
}
function plob(a,p){
       
     var d=document.getElementById("cangraphs");    
 new Chart(d, {
  type: 'line',
  data: {
    labels: a,
    datasets: [{ 
        data: p,
        
        label: "CONSUMPTIONS",
        borderColor: "#ff0000",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: "CONSUMPTIONS"
      
    },
     scales: {
 xAxes: [{ 
                gridLines: {
                    display: false
                },
                ticks: {
                  fontColor: "#000000" // this here
                }
            }],
            yAxes: [{ 
                gridLines: {
                    display: false
                },
                ticks: {
                  fontColor: "#000000" // this here
                }
            }]
  }
  }
});
       
        
}
function up_now(ko){
 if(ko==="1"){
  
   $(".configure_menu").css({visibility:"visible"}) ;  
    
  $(".graphs").css({visibility:"collapse"}) ;    
 }else if(ko==="2"){
   $(".graphs").css({visibility:"visible"}) ;  
  $(".configure_menu").css({visibility:"collapse"}) ;  
  get_graphs(); 
 }   
    
    
}
 

function get_graphs(){
    
     $.get("main.php",{get_graphs:""},function(data){
     var x=[];
     var y=[];
     var coun=0;
    
     var all=data.split("<>");
     all.forEach(function(current){
         var nook=current.split("//");
         
         x[coun]=parseInt(nook[0]);
            y[coun]=parseFloat(nook[1]);
           
       coun++;  
     });
     plob(x,y);
  }); 
}
function days_units(){
 $.get("main.php",{days:$('#days').val(),units:$('#units').val()},function(data){
     
    alert(data); 
 });   
    
}
window.onload=function(){
        $.get("main.php",{get_units_left:""},function(data){
     document.getElementById("display_units").innerHTML=data+" UNITS LEFT";
            
        });
        $.get("main.php",{not_indi:""},function(data){
            
           if(data==="true"){
           $("#notifi").attr("checked",!$("#notifi").attr("checked")); 
               
           }
        });
    };
        function noti_block(){
            
            $.get("main.php",{notifications_req:$("#notifi").prop('checked')},function(data){
                if($("#notifi").prop('checked'))
               notify("NOTIFICATIONS TURNED ON");
           else
               notify("NOTIFICATIONS TURNED OFF");
                
            });
            
        }
     
      function bring_graph(){
          
          var figure_in=$(".input_select").val();
        
          $.get("main.php",{get_graph_mode:figure_in},function(data){
     var x=[];
     var y=[];
     var coun=0;
    //alert(data);
     var all=data.split("<>");
     all.forEach(function(current){
         var nook=current.split("//");
         
         x[coun]=parseInt(nook[0]);
            y[coun]=parseFloat(nook[1]);
           
       coun++;  
     });
     plob(x,y);
  }); 
      }
      setInterval(function(){
         // $.get("main.php",{current_reading:"f=5.8||s=8.9||t=5.0"},function(){
              
             
        //  });
          
      },500);