package model;

import javax.persistence.SqlResultSetMapping;
import javax.servlet.jsp.jstl.sql.SQLExecutionTag;
import javax.xml.transform.Result;
import java.sql.*;
import java.util.*;
import java.util.concurrent.TimeUnit;
import java.util.stream.Collectors;

public class DBManager {
    private Statement stmt;

    public DBManager() {
        connect();
    }

    public void connect(){
        try{
            Class.forName("org.gjt.mm.mysql.Driver");
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/exam", "root", "");
            stmt = conn.createStatement();
        }
        catch (Exception ex){
            System.out.println("Error connecting to server:" + ex.getMessage());
            ex.printStackTrace();
        }
    }

    public User authenticate(String username, Integer securityNumber){
        ResultSet rs;
        User u = null;
        try{
            rs = stmt.executeQuery("select * from Persons where User = '" + username + "' and SecretNumber = " + securityNumber);
            if (rs.next()){
                Integer userId = rs.getInt("PersonID");
                String pictureFile = rs.getString("PictureFile");
                String name = rs.getString("Name");
                String familyMembers = rs.getString("FamilyMembers");
                u = new User(userId, username, securityNumber, name, pictureFile, familyMembers);
            }
            rs.close();
        }
        catch (SQLException sqle){
            System.out.println("Error authenticating!");
            sqle.printStackTrace();
        }
        return u;
    }

    public List<String> getFamilyMembers(String familyMembers){
        System.out.println(familyMembers);
        List<Integer> ids = Arrays.stream(familyMembers.split(",")).map(Integer::parseInt).collect(Collectors.toList());
        List<String> names = new ArrayList<>();
        User u = null;
        for (Integer id : ids){
            try{
                ResultSet rs = stmt.executeQuery("select * from Persons where PersonID = " + id);
                if (rs.next()){
                    names.add(rs.getString("name")); }
                    rs.close();
            }
            catch (SQLException exc){
                exc.printStackTrace();
            }
        }
        return names;
    }

    public Set<String> getMyFamilyMembers(Integer userId){
        Set<String> names = new HashSet<>();
        try{
            ResultSet rs = stmt.executeQuery("SELECT * FROM Persons WHERE FamilyMembers LIKE '%" + userId +"%'");
            while (rs.next()){
                String name = rs.getString("Name");
                names.add(name);
            }
        }
        catch (SQLException exc){
            exc.printStackTrace();
        }
        return names;
    }

    public Set<String> getFirstFriends(Integer userId){
        Set<String> names = new HashSet<>();
        try{
            ResultSet rs = stmt.executeQuery("select * from friend where FriendA = " + userId + " OR FriendB = " + userId);
            List<Integer> ids = new ArrayList<>();
            while (rs.next()){
                Integer friendId = (rs.getInt("FriendA") == userId) ? rs.getInt("FriendB") : rs.getInt("FriendA");
                ids.add(friendId);
            }
            for (Integer id : ids){
                ResultSet nameSet = stmt.executeQuery("SELECT * FROM Persons WHERE PersonID = " + id);
                nameSet.next();
                names.add(nameSet.getString("Name"));
            }
        }
        catch (SQLException exc){
            exc.printStackTrace();
        }
        return names;
    }

    public Set<String> getSecondFriends(Integer userId){
        Set<String> names = new HashSet<>();
        try{
            ResultSet rs = stmt.executeQuery("select * from friend where FriendA = " + userId + " OR FriendB = " + userId);
            List<Integer> ids = new ArrayList<>();
            while (rs.next()){
                Integer friendId = (rs.getInt("FriendA") == userId) ? rs.getInt("FriendB") : rs.getInt("FriendA");
                ids.add(friendId);
            }
            for (Integer id : ids){
                ResultSet firstFriends = stmt.executeQuery("select * from friend where FriendA = " + id + " OR FriendB = " + id);
                List<Integer> ids2 = new ArrayList<>();
                while (firstFriends.next()){
                    Integer id2 = (firstFriends.getInt("FriendA") == id) ? firstFriends.getInt("FriendB") : firstFriends.getInt("FriendA");
                    ids2.add(id2);
                }
                for (Integer id2 : ids2){
                    names.add(getPersonName(id2));
                }
            }

        }
        catch (SQLException exc){
            exc.printStackTrace();
        }
        return names;
    }

    public String getPersonName(Integer personId){
        String name = "";
        try{
            ResultSet rs = stmt.executeQuery("SELECT * FROM Persons WHERE PersonID = " + personId);
            rs.next();
            name = rs.getString("Name");
        }
        catch (SQLException exc){
            exc.printStackTrace();
        }
        return name;
    }

    public List<Integer> getFamilyIds(Integer userId){
        List<Integer> ids = new ArrayList<>();
        try{
            ResultSet rs = stmt.executeQuery("SELECT * FROM Persons WHERE PersonID = " + userId);
            rs.next();
            String familyMembers = rs.getString("FamilyMembers");
            ids = Arrays.stream(familyMembers.split(",")).map(Integer::parseInt).collect(Collectors.toList());
        }
        catch (SQLException exc){
            exc.printStackTrace();
        }
        return ids;
    }

    public void removeFriendship(Integer id1, Integer id2){
        try{
            stmt.executeUpdate("DELETE FROM Friend WHERE FriendA = " + id1 + " AND FriendB = " + id2);
            stmt.executeUpdate("DELETE FROM Friend WHERE FriendA = " + id2 + " AND FriendB = " + id1);
        }
        catch (SQLException exc){
            exc.printStackTrace();
        }
    }

}
