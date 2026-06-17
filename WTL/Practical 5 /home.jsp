<%@ page import="java.sql.*" %>

<html>

<head>
<title>Student Information</title>
</head>

<body style="font-family: Arial; background:#f4f4f4; text-align:center;">

<h2 style="margin-top:20px;">
Student Information
</h2>

<%

try{

Class.forName("com.mysql.cj.jdbc.Driver");

Connection conn =
DriverManager.getConnection(
"jdbc:mysql://localhost:3306/stud",
"root",
""
);

PreparedStatement pst =
conn.prepareStatement("select * from info");

ResultSet rs = pst.executeQuery();

out.println("<br><br>");

out.println("<table border=1 align=center style='border-collapse:collapse;width:50%;background:white;'>");

out.println("<tr style='background:#ff5b5b;color:white;height:40px'>");

out.println("<th>Name</th><th>Address</th>");

out.println("</tr>");

while(rs.next()){

out.println("<tr style='text-align:center;height:35px'>");

out.println("<td>"+rs.getString("name")+"</td>");

out.println("<td>"+rs.getString("address")+"</td>");

out.println("</tr>");

}

out.println("</table>");

}
catch(Exception e){

out.println("<p style='color:red;'>Error: "+e+"</p>");

}

%>

<br><br>

<a href="index.html">

<button style="padding:10px 20px;
background:MediumSeaGreen;
color:white;
border:none;
border-radius:5px;">

Logout

</button>

</a>

</body>
</html>
