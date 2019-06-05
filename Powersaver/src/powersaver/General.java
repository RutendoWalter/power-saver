/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package powersaver;

import java.sql.*;
import java.util.*;
import javax.swing.JOptionPane;
import javax.swing.table.DefaultTableModel;


/**
 *
 * @author Walter
 */
public class General {
 
    public static Object getMysq() throws SQLException,java.lang.ClassNotFoundException{
        try{
        Class.forName("java.sql.Driver");
        Connection conn=(Connection)DriverManager.getConnection("jdbc:mysql://localhost:3306/powersaver","root","71422041995");
        return conn;
        }catch(Exception e){
            JOptionPane.showMessageDialog(null,e.getMessage());
        return new Object[]{};
        }
    }
    public Object getMysql() throws SQLException,java.lang.ClassNotFoundException{
        Class.forName("java.sql.Driver");
        Connection conn=(Connection)DriverManager.getConnection("jdbc:mysql://localhost:3306/powersaver","root","71422041995");
        return conn;
    }
   
   
    
}
