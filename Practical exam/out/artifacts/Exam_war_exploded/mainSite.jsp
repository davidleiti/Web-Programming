<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Main site</title>
    <script src = "js/jquery-2.0.3.js"></script>
    <script src = "js/ajaxHandlers.js"></script>
</head>
<body>
<%! model.User user; %>
<% user = (model.User)session.getAttribute("user");
    if (user != null){
        System.out.println("Welcome " + user);
%>
<div style = "display: none" id = "userId"><%=user.getId()%></div>
<div>Login successful!</div>
<form action = "PersonController" method="get">
    <input type="hidden" name = "action" value="myFamilyMembers">
    <input type="submit" value = "Get family">
</form>
<form>
    <fieldset>
            <table>
                <tr>
                    <td>First friends</td>
                    <td><input type="button" id = "firstFriends" value = "Ok"></td>
                </tr>
                <tr>
                    <td>Second friends</td>
                    <td><input type="button" id = "secondFriends" value = "Ok"></td>
                </tr>
                <tr>
                    <td><div id = "resultDiv"></div></td>
                </tr>
            </table>
    </fieldset>
</form>
<form action = "PersonController" method="post">
    <label>Enemy id:</label><input type="text" name = "enemyId">
    <input type="submit" value = "Declare enemy">
</form>
<table>
    <tr>
        <td>Name: </td>
        <td><%=user.getName()%></td>
    </tr>
    <tr>
        <td>User: </td>
        <td><%=user.getUsername()%></td>
    </tr>
    <tr>
        <td>Family members: </td>
        <td id = "familyMembers"><%=user.getFamilyMembers()%></td>
    </tr>
</table>
<img src="<%=user.getPictureFile()%>">

</body>
</html>
<%
    }
%>