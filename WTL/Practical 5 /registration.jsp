<%@ page import="java.sql.*" %>

<%

String name = request.getParameter("name");
String gender = request.getParameter("gender");
String email = request.getParameter("email");
String college = request.getParameter("college");
String branch = request.getParameter("branch");
String mobile = request.getParameter("mobile");
String username = request.getParameter("username");
String pass = request.getParameter("password");

try{

Class.forName("com.mysql.cj.jdbc.Driver");

Connection conn =
DriverManager.getConnection(
"jdbc:mysql://localhost:3306/stud",
"root",
""
);

String sql =
"insert into reg values(?,?,?,?,?,?,?,?)";

PreparedStatement pst =
conn.prepareStatement(sql);

pst.setString(1,name);
pst.setString(2,gender);
pst.setString(3,email);
pst.setString(4,college);
pst.setString(5,branch);
pst.setString(6,mobile);
pst.setString(7,username);
pst.setString(8,pass);

pst.executeUpdate();

response.sendRedirect("Signin.html");

}
catch(Exception e){
out.println(e);
}

%>
