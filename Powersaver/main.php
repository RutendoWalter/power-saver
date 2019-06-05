<?php
require 'most.php';

if(isset($_REQUEST['user_data'])){
 $conn=new process();
 $all=strtolower(trim(htmlspecialchars($_REQUEST['user_data'])));
 echo $all;
 $u=explode("||",$all)[0];
 $da=explode("||",$all)[1];
 $f=false;
 $up=explode(" ",$u);
 $ud=explode(" ",$da);
 $co=$conn->PDO();
 $sql="delete from user_data";
 $stb=$co->prepare($sql);
 
if( $stb->execute()){
 $f=$conn->place("user_data", "'".$up[1]."','".$ud[1]."','".date("z")."'");
}
 if($f){
     echo "true";
     
 }else{
     
     echo "false";
 }
    
}elseif(isset($_REQUEST['mode_hardware'])){
 $conn=new process();
 $mode=strtolower(trim($_REQUEST['mode_hardware']));
 $smode="";
 if($mode==="w1"){
   $smode="normal";  
     
 }elseif($mode==="w2"){
   $smode="powersaver";   
 }else{
     $smode="strict"; 
     
 }
 $co=$conn->PDO();
 $sql="update mode set mode='".$smode."'";
 $stm=$co->prepare($sql);
 $stm->execute();
 echo "set";
    
}elseif(isset($_REQUEST['schedule'])){
   
 $h=date("H");
 $m=date("i");
 $d=date("D");
 $da=date("z");
 $conn=new process();
$conn=new process();
 $out="";
$out.=$conn->bring_state_relay("relay1",$d);
$out.=$conn->bring_state_relay("relay2",$d);
$out.=$conn->bring_state_relay("relay3",$d);
echo $out;      
        
    
}elseif(isset($_REQUEST['mode_get'])) {
 $conn=new process();
 
 $stm=$conn->select_all_from_table("mode");
 
 while ($resu=$stm->fetch()){
     echo trim($resu['mode']);
    break;
 }
}elseif(isset($_REQUEST['current_reading'])){
  $all=  explode("||",trim($_REQUEST['current_reading']));
  $conn=new process();
  $r=1;
  foreach ($all as $current){
  //update table each by each  
      $pep=explode("=",$current);
     
    $conn->update_values($r,  floatval($pep[1]) );
            $r++;
  }
 
    
}elseif(isset($_GET['password'])){
 $conn=new process();
 $stm=$conn->select_all_from_table("login");
 while($resu=$stm->fetch()){
     if($resu['password']===strtolower(trim($_GET['password']))){
      $_SESSION['user']=true;
      echo "true";
         
     }else{
         echo "false";
     }
   break;  
 }
    
}elseif(isset($_GET['enter_schedule'])){
  $lola=strtolower(trim($_GET['enter_schedule']));
  $conn=new process();
  $all=explode("||",$lola);
  $relay="";
  $now=explode("//",$all[0]);
 
  if($now[0]==="r1"){
  $relay="relay1";    
      
  }elseif($now[0]==="r2"){
      
      $relay="relay2";
  }elseif($now[0]==="r3"){
   $relay="relay3";   
      
  }
  
  $day=$conn->bring_day($now[1]);
  $h=$conn->update("scheduler", $relay, strtolower(substr($lola, 7,  strlen($lola))), "day", trim($day)) ;
  if($h==true){
      echo "ok";
  }else{
      echo "error";
  }
}elseif(isset($_GET['mode'])){
$mode=  strtolower(trim(htmlspecialchars($_GET['mode'])));
$conn=new process();
$c=$conn->PDO();
$str="update mode set mode='".$mode."'";
$stm=$c->prepare($str);
$f=$stm->execute();
if($f){
 echo ucwords($mode);   
}else{
  echo "error";  
}
    
}elseif(isset($_GET['get_graphs'])){
    $co=new process();
$d=date("z");
$t=$co->table_exists("a".$d);
$sent="";
if($t){
  //read from table 
$sg=$co->select_all_from_table("a".$d);
while($resu=$sg->fetch()){
    $one=$resu['kwh1'];
    $two=$resu['kwh2'];
    $three=$resu['kwh3'];
    $total=0.00;
    
    if($one!==""){
      $total=$total+  floatval($resu['kwh1']);  
    }
    if($two!==""){
     $total=$total+  floatval($resu['kwh2']);       
    }
    if($three!==""){
     $total=$total+  floatval($resu['kwh3']);       
    }
  if($sent==""){
      $sent=$resu['hour']."//".$total;
}else{
    $sent.="<>".$resu['hour']."//".$total;
}  
    
}
//on to prediction stage
echo $sent;
}else{
 //create table 
    $conn=new process();
    $conn=$co->PDO();
    $sql="create table a".$d."(hour text not null,kwh1 text not null,kwh2 text not null,kwh3 text not null)";
    $stm=$conn->prepare($sql);
    $f=$stm->execute();
    if($f){
    echo "0"   ; 
        
    }else{
        echo "error";
        
    }
}
    
    
}elseif(isset($_GET['days'])&&isset($_GET['units'])){
 $conn=new process();
 $days=strtolower(trim($_GET['days']));
 $units=strtolower(trim($_GET['units']));
 $sql="delete from user_data";
 $co=$conn->PDO();
 $stm=$co->prepare($sql);
 $stm->execute();
 $cv=false;
$cv=$conn->place("user_data", "'".$units."','".$days."','".date("z")."'");
if($cv){
   echo "ok"; 
    
}else{
    echo "error";
}
}elseif(isset($_GET['get_units_left'])){
  $conn=new process();
  $stm=$conn->select_all_from_table("user_data");
  while($resu=$stm->fetch()){
  echo $resu['units'];    
    break;  
  }
    
}elseif(isset($_GET['notifications_req'])){
  $conn=new process();
    $co=$conn->PDO();
 $req=  strtolower(trim($_GET['notifications_req']));

  if($req==="true"){
  $sql="update noti set noti='true'";}
  else{
  $sql="update noti set noti='false'";    }
 $stn=$co->prepare($sql);
 $stn->execute();
 echo "set";
}elseif(isset($_GET['not_indi'])){
    $conn=new process();
    $stm=$conn->select_all_from_table("noti");
    while($resu=$stm->fetch()){
    echo $resu['noti'];
    break;
        
    }
            
}elseif(isset($_GET['get_graph_mode'])){
    $non=strtolower(trim($_GET['get_graph_mode']));
    $co=new process();
    $d=date("z");
   // $d=147;
    $t=$co->table_exists("a".$d);
$sent="";

     


if($t&&$non!=="month"){
  //read from table 
    if($non==="combined"){
$sg=$co->select_all_from_table("a".$d);
while($resu=$sg->fetch()){
    $one=$resu['kwh1'];
    $two=$resu['kwh2'];
    $three=$resu['kwh3'];
    $total=0.00;
    
    if($one!==""){
      $total=$total+  floatval($resu['kwh1']);  
    }
    if($two!==""){
     $total=$total+  floatval($resu['kwh2']);       
    }
    if($three!==""){
     $total=$total+  floatval($resu['kwh3']);       
    }
  if($sent==""){
      $sent=$resu['hour']."//".$total;
}else{
    $sent.="<>".$resu['hour']."//".$total;
}  
    
}
//on to prediction stage
echo $sent;  
    
}
else{
     

  //read from table 
$sg=$co->select_all_from_table("a".$d);
while($resu=$sg->fetch()){
    $one=$resu['kwh1'];
    $two=$resu['kwh2'];
    $three=$resu['kwh3'];
    $total=0.00;

    if($non==="relay 1"&&$one!==""){
      $total=$total+  floatval($resu['kwh1']);  
    }elseif($non==="relay 2"&&$two!==""){
     $total=$total+  floatval($resu['kwh2']);       
    }elseif($non==="relay 3"&&$three!==""){
     $total=$total+  floatval($resu['kwh3']);       
    }
  if($sent==""){
      $sent=$resu['hour']."//".$total;
}else{
    $sent.="<>".$resu['hour']."//".$total;
}

    

//on to prediction stage
}
echo $sent;  
 
    


}
}else{
 $start=$d-30;
 while($start<=$d){
     if($co->table_exists("a".$start)){
     $sg=$co->select_all_from_table("a".$start);
   
while($resu=$sg->fetch()){
    $one=$resu['kwh1'];
    $two=$resu['kwh2'];
    $three=$resu['kwh3'];
    $total=0.00;
    
    if($one!==""){
      $total=$total+  floatval($resu['kwh1']);  
    }
    if($two!==""){
     $total=$total+  floatval($resu['kwh2']);       
    }
    if($three!==""){
     $total=$total+  floatval($resu['kwh3']);       
    }
  if($sent==""){
      $sent=$start.$resu['hour']."//".$total;
}else{
    $sent.="<>".$start.$resu['hour']."//".$total;
}  
    
}
//on to prediction stage
 
   
     
 }
 $start++;
 }
 echo $sent; 
    
}

}

