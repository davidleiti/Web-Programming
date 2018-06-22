package controller;

import model.DBManager;
import model.User;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;

@WebServlet(name = "LoginController")
public class LoginController extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String username = request.getParameter("username");
        Integer number = Integer.parseInt(request.getParameter("securityNumber"));
        RequestDispatcher rd;
        DBManager dbmanager = new DBManager();
        User user = dbmanager.authenticate(username, number);
        if (user != null) {
            rd = request.getRequestDispatcher("/mainSite.jsp");
            HttpSession session = request.getSession();
            session.setAttribute("user", user);
        } else {
            rd = request.getRequestDispatcher("/index.jsp");
        }
        rd.forward(request, response);
    }
}
