/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package powersaver;

import com.sun.speech.freetts.Voice;
import com.sun.speech.freetts.VoiceManager;
import java.awt.Frame;
import java.sql.*;
import javax.swing.JOptionPane;

/**
 *
 * @author WALTER CHIFAMBA
 */
public class Powersaver {

    /**
     * @param args the command line arguments
     */
     static String mode_master="";
     static int hour_master=0;
    public static void main(String[] args) {
        // TODO code application logic here
        mode_master=get_mode();
        General g=new General();
        Connection conn;
        try{
        conn=(Connection)g.getMysql();
         while(true){
             int i=0;
             Virus virus=new Virus();
         Object obj=virus.kk();
         String all[]=obj.toString().split(" ");
         String all2[]=all[3].split(":");
         int hour=Integer.parseInt(all2[0]);
         
         //System.out.println(obj.toString());
        try{
        Thread.sleep(1000);
        String sql="select * from noti";
        Statement stm=conn.createStatement();
        ResultSet rs=stm.executeQuery(sql);
        while(rs.next()){
        if(rs.getString("noti").equals("true")){
        if(hour>Integer.parseInt(rs.getString("hour"))){
        i=i+1;
       
        }
        }
        }
        if(i>0){
        //get mode and speak mode
            say("it is now "+hour+"oclock and the house is in "+get_mode()+" mode");
            update_hour();
        }
        }catch(Exception e){
        System.out.println(e.getMessage());
        }
        if(!get_mode().equals(mode_master)&&get_noti_set()){
        mode_master=get_mode();
        say("House is now in "+mode_master+"mode");
        Thread.sleep(1000);
        say("House is now in "+mode_master+"mode");
        Thread.sleep(3000);
        say("House is now in "+mode_master+"mode");
        Thread.sleep(5000);
        say("House is now in "+mode_master+"mode");
        Thread.sleep(10000);
        say("House is now in "+mode_master+"mode");
        }
        
    }
        }catch(Exception e){
        }
       
    }
      public  static void say(String ok){
          if(get_noti_set()){
    Voice voice;
    try{
    VoiceManager vc=VoiceManager.getInstance();
    voice=vc.getVoice("kevin16");
    voice.allocate();
    voice.speak(ok);
    }catch(Exception e){
  
    JOptionPane.showMessageDialog(null,e.getMessage());
    
    }
          }
    }
        public  static String get_mode(){
            String mode="";
        try{
            General g=new General();
            Connection conn=(Connection)g.getMysql();
            Statement stm=conn.createStatement();
            ResultSet rst=stm.executeQuery("select * from mode");
            while(rst.next()){
           mode= rst.getString("mode");
            }
        }catch(Exception e){
        
        JOptionPane.showMessageDialog(null,e.getMessage());
        }
        return mode;
        }
        public static int get_hour(){  Virus virus=new Virus();
         Object obj=virus.kk();
         String all[]=obj.toString().split(" ");
         String all2[]=all[3].split(":");
         int hour=Integer.parseInt(all2[0]);
         return hour;
        
        }
        public static void update_hour(){
        int hou=get_hour();
        try{
        General g=new General();
        Connection conn=(Connection)g.getMysql();
        String  sql="update noti set hour='"+hou+"'";
        Statement stm=conn.createStatement();
        stm.executeUpdate(sql);
        
        }catch(Exception e){
        JOptionPane.showMessageDialog(null,e.getMessage());
        }
        }
  
        public static boolean get_noti_set(){
            boolean no=false;
try{
General g=new General();
Connection conn=(Connection)g.getMysql();
String sql="select * from noti";
Statement stm=conn.createStatement();
ResultSet rs=stm.executeQuery(sql);
while(rs.next()){
if(rs.getString("noti").equals("true")){
no=true;
}
}
}catch(Exception e){
JOptionPane.showMessageDialog(null,e.getMessage());
}
return no;
}
}


