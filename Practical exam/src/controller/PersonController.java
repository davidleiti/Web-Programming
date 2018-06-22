package controller;

import model.DBManager;
import model.User;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.List;
import java.util.Set;

@WebServlet(name = "PersonController")
public class PersonController extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        int userId = ((User)request.getSession().getAttribute("user")).getId();
        int enemyId = Integer.parseInt(request.getParameter("enemyId"));
        DBManager dbManager = new DBManager();
        List<Integer> familyIds = dbManager.getFamilyIds(userId);
        dbManager.removeFriendship(userId, enemyId);
        for (Integer id : familyIds){
            dbManager.removeFriendship(id, enemyId);
        }
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        int userId = ((User)request.getSession().getAttribute("user")).getId();
        String action = request.getParameter("action");
        System.out.println("in get handler");
        if (action.equals("familyMembers")){
            DBManager dbManager = new DBManager();
            String familyMembers = request.getParameter("val");
            List<String> members = dbManager.getFamilyMembers(familyMembers);
            JSONArray jsonArray = new JSONArray();
            for (String member: members){
                JSONObject object = new JSONObject();
                object.put("member", member);
                jsonArray.add(object);
            }
            PrintWriter printWriter = new PrintWriter(response.getOutputStream());
            printWriter.println(members);
            printWriter.flush();
        }
        if (action.equals("myFamilyMembers")){
            DBManager dbManager = new DBManager();
            Set<String> members = dbManager.getMyFamilyMembers(userId);
            JSONArray jsonArray = new JSONArray();
            for (String member: members){
                JSONObject object = new JSONObject();
                object.put("member", member);
                jsonArray.add(object);
            }
            PrintWriter printWriter = new PrintWriter(response.getOutputStream());
            printWriter.println(members);
            printWriter.flush();
        }
        if (action.equals("firstFriends")){
            DBManager dbManager = new DBManager();
            Set<String> friends = dbManager.getFirstFriends(userId);
            PrintWriter printWriter = new PrintWriter(response.getOutputStream());
            printWriter.println(friends);
            printWriter.flush();
        }
        if (action.equals("secondFriends")){
            DBManager dbManager = new DBManager();
            Set<String> friends = dbManager.getSecondFriends(userId);
            friends.remove(dbManager.getPersonName(userId));
            PrintWriter printWriter = new PrintWriter(response.getOutputStream());
            printWriter.println(friends);
            printWriter.flush();
        }
    }
}
