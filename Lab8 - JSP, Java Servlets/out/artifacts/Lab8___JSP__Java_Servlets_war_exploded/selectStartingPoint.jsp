<%--
  Created by IntelliJ IDEA.
  User: David
  Date: 5/18/2018
  Time: 7:31 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>TempSuccess</title>
</head>
<body>
<%! model.User user; %>
<% user = (model.User)session.getAttribute("user");
    if (user != null){
        System.out.println("Welcome " + user.getUsername());
%>
<div>Login successful!</div>
<form action = "RouteController" method="post">
    <input type = "text" name = "city">
    <input type = "submit" value = "Start">
    <input type = "hidden" name = "all" value = "false">
</form>
</body>
</html>
<%
    }
%>
