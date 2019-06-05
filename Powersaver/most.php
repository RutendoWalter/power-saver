<?php

function getPDO(){
    $conn = new PDO("mysql:host=localhost;dbname=powersaver","root","71422041995");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $conn;
}

class process{
    function PDO(){
 $conn = new PDO("mysql:host=localhost;dbname=powersaver","root","71422041995");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function bring_state_relay($relay,$d){
    
    $tv=$this->select_all_from_table("mode");
    $j="";
    while($resu=$tv->fetch()){
    $j=$resu['mode'];    
        
    }
    $strictd=true;
    if($j==="strict"){
     //get days from user_data and then calculate scheduled for that day   
     $db=date("z");
     $lapse=0;
     $last=0;
     $uni=0.00;
     $stm=$this->select_all_from_table("user_data");
     while($resu=$stm->fetch()){
      $last=intval($resu['sta']);   
       $lapse=($last-$db);  
       $uni=floatval($resu['units']);
     }
     if($uni!==0&&$lapse!==0&&$this->table_exists("a".$db)){
     $total=0.00;
     $stm2=$this->select_all_from_table("a".$db);
     while($resu=$stm2->fetch()){
         
      $total=$total+floatval($resu['kwh1']) +floatval($resu['kwh2'])+floatval($resu['kwh3']);
     
     }
     $dallow=$uni/$lapse;
     $hd=date("H");
     $callow=0.00;
     if($hd<7){
       $callow=($dallow*(1/12));  
     }elseif($hd<12){
        $callow=($dallow*(4/12));    
     }elseif($hd<18){
          $callow=($dallow*(5.5/12));  
     }elseif($hd<24){
          $callow=($dallow);  
         
     }
     if($total>$callow){
      
       return "off";
         
     }
     
     }
     
    }
    if($j!=="normal"&&$strictd){
  $stm=$this->select_from_table("scheduler", "day", strtolower($d));
  $rel=false;
    $h=trim(date("H"));
      $m=trim(date("i"));
    
 while($resu=$stm->fetch()){
   if($resu[$relay]!==""){
 $all1=explode("||",$resu[$relay]);
 foreach ($all1 as $current){
 $k=explode("[]",$current);
 $b=explode(":",$k[0]);
 $c=explode(":",$k[1]);
 $from=  intval($b[0].$b[1]);
 $to=intval($c[0].$c[1]);
 $curr=intval($h.$m);
 
 if($curr>=$from&&$curr<=$to){
     $rel=true;
 }
 }
   
 }else{
    // echo "empty";
     
 }
  break;
 }   
    }else{
        return "onn";
    }
 if($rel){
     
     return "onn";
 }else{
     return "off";
 }
    }

function check_regular($relay,$d){
     $tv=$this->select_all_from_table("mode");
    $j="";
    while($resu=$tv->fetch()){
    $j=$resu['mode'];    
        
    }
    if($j!=="normal"){
  $stm=$this->select_from_table("scheduler", "day", strtolower($d));
  $rel=false;
    $h=trim(date("H"));
      $m=trim(date("i"));
    
 while($resu=$stm->fetch()){
   if($resu[$relay]!==""){
 $all1=explode("||",$resu[$relay]);
 foreach ($all1 as $current){
 $k=explode("[]",$current);
 $b=explode(":",$k[0]);
 $c=explode(":",$k[1]);
 $from=  intval($b[0].$b[1]);
 $to=intval($c[0].$c[1]);
 $curr=intval($h.$m);
 
 if($curr>=$from&&$curr<=$to){
     $rel=true;
 }
 }
   
 }else{
    // echo "empty";
     
 }
  break;
 }   
    }else{
        return "onn";
    }
 if($rel){
     
     return "onn";
 }else{
     return "off";
 } 
}
function bring_day($i){
if($i=="1"){
 return "mon";   
}elseif($i=="2"){return "tue";}elseif($i==="3"){return "wed";

}elseif($i==="4"){return "thu";}elseif($i==="5"){return "fri";}elseif($i==="6"){return "sat";}
elseif($i==="7"){return "sun";}else{return "";}

  
    
}
function table_exists($come){
   
    $conn=$this->PDO();
    $sql="select * from information_schema.tables where table_schema='powersaver' and table_name='".$come."' limit 1";
    
    $stm=$conn->prepare($sql);
    $stm->execute();
    if($stm->rowCount()>0){
        return true;
    }else{
        return false;
    }
    
   
    
}
function select_all_from_table($str){
    
    $conn=$this->PDO();
    $sql="select * from ".$str;
    $stm=$conn->prepare($sql);
    $stm->execute();
    return $stm;
}
function check_first($email){
    $conn= $this->PDO();
    $sql="select * from infor where email='".strtolower(trim($email))."' limit 1";
    $stm=$conn->prepare($sql);
    $stm->execute();
    $co=0;
    $coun=0;
    while($res=$stm->fetch()){
        if($res['user']===""||$res['user']==NULL){
            $coun+=1;
        }
       $co+=1; 
    }
    if($co==0){
      //session for infor set
        return true;
    }else{
        return false;
    }
    
}
function check_second($email){
   $conn= $this->PDO();
    $sql="select * from others where user='".strtolower(trim($email))."' limit 1";
    $stm=$conn->prepare($sql);
    $stm->execute();
    $co=0;
    $coun=0;
    while($res=$stm->fetch()){
        if($res['user']===""||$res['user']==NULL){
            $coun+=1;
        }
       $co+=1; 
    }
    if($co==0){
      //session for infor set
        return true;
    }else{
        return false;
    }  
    
}
function  place($tab,$va){
   $co=$this->PDO();
   $all=explode(",",$va);
   $stm=$co->prepare("select * from ".$tab);
   $stm->execute();
   $th=true;
  
 
    $con=$this->PDO();
    $sql="insert into ".$tab." values(".$va.")";
    $st=$con->prepare($sql);
    if($st->execute()){
        return true;
    }else{
        return false;
    }
  
  
    
}
function remove($table,$column,$value){
    $con=  $this->PDO();
    $sql="delete from ".$table." where ".$column."='".$value."'";
    $stm=$con->prepare($sql);
    if($stm->execute())
    {return true;}else{return false;}
    
    
    
}
function update($table,$column1,$value1,$column2,$value2){
    $con=  $this->PDO();
    $sql="update ".$table." set ".$column1."='".$value1."' where ".$column2."='".$value2."'";
    $stm=$con->prepare($sql);
    if($stm->execute()){return true;}else{return false;}
    
}
function select_from_table($table,$column,$identifier){
    $con= $this->PDO();
    $sql="select * from ".$table." where ".$column."='".$identifier."' limit 1";
    $stm=$con->prepare($sql);
    $stm->execute();
    
    return $stm;
}


function bring_last($tmp,$t){
   
  $a=explode("<>",$tmp);
    $l="";
    foreach ($a as $current) {
     $l=$current;   
    }
    $as=explode("//",$l);
     if($t==="m"||$t==="t"){
    $q=intval($as[0]);
     }else{
         $q=$as[0];
     }
    return $q;

}
function update_values($i,$curre){
   
$curre=(((floatval($curre)/sqrt(2))*220)/1000)*(3/(60*60));
 
$da=trim(date("z"));
$h=date("H");
$prev=0.00;

if($this->table_exists("a".$da)){
$stm=$this->select_from_table("a".$da, "hour", $h);
$ii=0;
while($resu=$stm->fetch()){
    if($resu['kwh'.$i]!=="")
$prev=floatval($resu['kwh'.$i]);
    $ii++;
    break;
}
if($ii!==0){
if($curre!==""&&$prev!==""){
 $v=$this->update("a".$da, "kwh".$i, ($curre+$prev), "hour", $h); 
}
}else{
    if($curre!==""&&$prev!==""){
 $db=$this->place("a".$da, "'".$h."','','',''");   
 

 $v=$this->update("a".$da, "kwh".$i, $curre, "hour", $h); 
}  
}

}else{
//create table 
   $coj=$this->PDO();
    $sql="create table a".$da."(hour text not null,kwh1 text not null,kwh2 text not null,kwh3 text not null)";
    $stm=$coj->prepare($sql);
    $f=$stm->execute();
    if($f){
$db=$this->place("a".$da, "'".$h."','','',''");
if($curre!==""&&$prev!=""){
 $v=$this->update("a".$da, "kwh".$i, ($curre+$prev), "hour", $h); 
 }
    echo "ok"   ; 
    }else{
   echo "error";
        
    }    
    
}   
 $cc=floatval($curre);
 $stt=$this->select_all_from_table("user_data");
 $old=0.00;
 while($resu=$stt->fetch()){
    $old=  floatval($resu['units']); 
  break;   
 }
$sql="update user_data set units='".($old-$cc)."'";
$conn=$this->PDO();
$sth=$conn->prepare($sql);
$sth->execute();
}

}

