<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .door_log{
             position: absolute;
             top:0%;
            
             width:25%;
             height:100%;
            visibility: visible;
              //visibility:collapse;  
            }
            .login{
               
                position:absolute;
                top:40%;
                left:35%;
                width:30%;
                height:13%;
             visibility:collapse;
             border:1px solid grey;
             border-radius:10px;
             background-color: rgba(0,0,0,0.7);
             z-index:10;
                
            }
            .input{
            border-radius: 3px;
            text-align:center;
            font-family: georgia;
                
            }
            .content{
                
             position:absolute;
             top:0%;
             left:0%;
             width:100%;
             height:100%;
             color:white;
             
            }
            body{
                overflow-x: hidden;
               background-image:url("images/body3.jpg");
               background-size:cover;
            }
            .configure{
                position:absolute;
               
                left:1%;
                width:30%;
                height:15%;
                background-image: url("images/login3.png");
                background-size: contain;
                background-repeat: no-repeat;
                visibility:collapse;
            }
             .configure2{
                position:relative;
               top:1%;
                left:1%;
                width:50%;
                height:25%;
                background-image: url("images/login3.png");
                background-size: contain;
                background-repeat: no-repeat;
                visibility:collapse;
            }
            .configure3{
                position:relative;
               top:1%;
                left:1%;
                width:100%;
                height:20%;
                background-image: url("images/login3.png");
                background-size: contain;
                background-repeat: no-repeat;
               
            }
            .configure3:hover{
                cursor:pointer;
                width:98%;
                height:19%;
                
            }
            .label{
            position: relative;
            top:55%;
            left:6%;
            font-family: georgia;
            font-weight:500;
           font-size: inherit;
            }
            .configure:hover{
                
                cursor:pointer;
                width:29.5%;
                height:14.5%;
            }
            .configure_menu{
             position:absolute;
             top:8%;
             left:20%;
             height:60%;
             width:70%;
             z-index:0;
                visibility:collapse;
            }
            .top_table{
            position: relative;
            top:1%;
            left:1%;
            width:98%;
            height:5%;
           
                
            }
            .bottom_table{
                
              position: relative;
            top:6%;
            left:1%;
            width:98%;
            height:75%;  
            table-layout: fixed;
            }
            .relay{
             position: absolute;   
            max-width:50px;
            max-height:20px;
            background-image: url("images/login.jpg");
            }
            .in{
            position:absolute;
            max-height: 100%;
            max-width: 100%;
                
            }
            .start1{
             position: absolute;
             top:8%;
             left:20%;
             width:25%;
             height:98%;
                
            }
            .backboard{
             position: absolute;
             top:0%;
             left:0%;
             width:100%;
             height:100%;
             background-color: rgba(0,0,0,0.7);
             visibility: collapse;
              z-index: 1;   
            }
            .enter_times{
            position: absolute;
            top:20%;
            left:25%;
            background-color: white;
            width:40%;
            height:70%;
            box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7);
            border-radius:5px;   
            z-index: 2;
            visibility: collapse;
            }
            .graphs{
               position:absolute;
             top:8%;
             left:20%;
             height:60%;
             width:70%;
              visibility:collapse;  
            }
            #cangraphs{
              position: absolute;
              top:13%;
              left:0%;
              width:98%;
              height:83%;
             
            }
            .notifications{
              position: absolute;
            top:20%;
            left:25%;
            background-color: white;
            width:40%;
          text-align: center;
            box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7);
            border-radius:5px;   
            z-index: 2;
           visibility: collapse;  
                
            }
            .display_units{
                position:absolute;
                top:1%;
                left:1%;
                width:98%;
                height:4%;
                text-align:center;
                font-family:georgia;
                font-size: 150%;
              visibility:collapse; 
            }
            .input_select{
               position:absolute;
                top:6%;
                left:1%;
                width:15%;
                height:6%;
                text-align:center;
                font-family:georgia;
                font-size: 100%;
                box-shadow:1px 1px 1px 1px rgba(0,0,0,0.6);
             //visibility:collapse;    
                
            }
            .req_noti{
                position:absolute;
                top:1%;
                left:50%;
                width:5%;
                height:5%;
                z-index:0;
               visibility:collapse; 
            }
            .not_in{
              position: absolute;
              top:0%;
              left:0%;
              width:100%;
              height:100%;
                
            }
        </style>
    </head>
    <body>
        <?php
        // put your code here
        ?>
       
        <img  id="one" style="left:0%;" class="door_log"  src="images/jap1.jpg" />
            <img onclick="shake(this.id)"  id="two" style="left:25%;" class="door_log"  src="images/jap2.jpg" />
                <img onclick="shake(this.id)" id="three" style="left:50%;" class="door_log"  src="images/jap3.jpg" />
                    <img  id="four" style="left:75%;" class="door_log"  src="images/jap4.jpg" />
                    <script type="text/javascript" src="jquery.js" ></script>
                    <div  class="login" >
                        <table class="content" >
                            
                            <tr><td>PASSWORD:</td><td><input id="password" type="text" class="input"  /></td></tr> 
                        </table>
                        
                        </div>
                        
                    <div onclick="up_now('1')"  style="top:1%;"  class="configure" >
                        
                        <div class="label" >CONFIGURE</div>   
                    </div>
                    <div onclick="up_now('2')" style="top:15%;"  class="configure" >
                        <div class="label" >GRAPHS</div>   
                    </div>
                    <div onclick="choose('normal')" id="normal" style="top:30%;"  class="configure" >
                        <div class="label" >NORMAL</div>   
                    </div>
                     <div onclick="choose('powersave')" id="powersave" style="top:45%;"  class="configure" >
                        <div class="label" >POWERSAVE</div>   
                    </div>
                    <div onclick="choose('strict')" id="strict" style="top:60%;"  class="configure" >
                        <div class="label" >STRICT</div>   
                    </div>
                    <div  class="configure_menu" >
                        <table class="top_table" >
                            <tr><td>DAYS:</td><td><input id="days" class="input" type="text" /></td><td>UNITS:</td><td><input id="units" class="input" type="text" /></td><td><input value="ENTER" onclick="days_units()" class="input" type="button" /></td></tr>
                        </table>
                        <div style="left:1%;" class="start1" >
                          <div   style="top:1%;"  class="configure3" >
                        <div class="label" >MONDAY</div>   
                    </div>
                          <div     class="configure3" >
                        <div class="label" >TUESDAY</div>   
                    </div>
                          <div      class="configure3" >
                        <div class="label" >WEDNESDAY</div>   
                    </div>
                         <div      class="configure3" >
                        <div class="label" >THURSDAY</div>   
                    </div>
                         <div     class="configure3" >
                        <div class="label" >FRIDAY</div>   
                    </div>
                         <div     class="configure3" >
                        <div class="label" >SATURDAY</div>   
                    </div>
                         <div    class="configure3" >
                        <div class="label" >SUNDAY</div>   
                         </div>
                        </div>
                        <div class="start1" >
                            <?php
                            for($i=1;$i<8;$i++){
                            echo"
                            <div onclick=enter_mode(\"r1//".$i."\")  style='left:0%;top:1%;'  class='configure3' >
                        <div class='label' >RELAY 1</div>   
                            </div>";
                            }
                                    ?>
                    </div>
                         <div style="left:35%;" class="start1" >
                            <?php
                            for($i=1;$i<8;$i++){
                            echo"
                            <div onclick=enter_mode(\"r2//".$i."\")  style='left:0%;top:1%;'  class='configure3' >
                        <div class='label' >RELAY 2</div>   
                            </div>";
                            }
                                    ?>
                    </div>
                         <div style="left:50%;" class="start1" >
                            <?php
                            for($i=1;$i<8;$i++){
                            echo"
                            <div onclick=enter_mode(\"r3//".$i."\")  style='left:0%;top:1%;'  class='configure3' >
                        <div class='label' >RELAY 3</div>   
                            </div>";
                            }
                                    ?>
                    </div>
                     
                    </div>  
                    <div onclick='send_close()'  class="backboard" >
                     
                         
                    </div>
                       <div id="eee" class="enter_times" >
                         <table class='times' id="times" style='z-index: 10;'  >
                                <thead><th>FROM</th>
                            <th>TO</th><th></th>
                            </thead>
                            <tr><td><input id='from' value="00:00" type="text" class="input" /></td>
                                <td><input id='to' value="00:00" type="text" class="input" /></td>
                                <td><input onclick='add_tolist()' value="GO" type="button" class="input" /></td></tr>
                            </table>    
                            
                            
                        </div>
                    <div class="graphs" >
                        <div id="display_units" class="display_units" >75386 left</div>
                        <select class="input_select" onchange="bring_graph()" >
                            <option>COMBINED</option>
                            <option>RELAY 1</option>
                            <option>RELAY 2</option>
                            <option>RELAY 3</option>
                            <option>MONTH</option>
                        </select>
                        <canvas id="cangraphs" >
                            
                        </canvas>   
                        
                    </div>
                    <div id="noti" class="notifications" >
                        
                    </div>
                    <div  class="req_noti" >
                      <table class="not_in" >  
                          <tr>
                              <td>NOTIFICATIONS</td>
                              <td>
                        <input id="notifi" onchange="noti_block()" type="checkbox"  />
                              </td>
                      </tr>
                      </table>
                            
                     
                    </div>
                    <script type="text/javascript" src="Chart.js"></script>
                    <script type="text/javascript" src="Chart.min.js"></script>
                    <script type="text/javascript" src="jquery-ui.js" ></script>
                    <script type="text/javascript" src="index.js" ></script>
                   
                    
    </body>
</html>
