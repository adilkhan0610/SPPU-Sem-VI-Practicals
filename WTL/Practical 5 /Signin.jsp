<%@ page import="java.sql.*" %>

<%

String user = request.getParameter("username");
String pword = request.getParameter("password");

try{

Class.forName("com.mysql.cj.jdbc.Driver");

Connection conn =
DriverManager.getConnection(
"jdbc:mysql://localhost:3306/stud",
"root",
""
);

String sql =
"select * from reg where username=? and password=?";

PreparedStatement pst =
conn.prepareStatement(sql);

pst.setString(1,user);
pst.setString(2,pword);

ResultSet rs = pst.executeQuery();

if(rs.next()){
response.sendRedirect("home.jsp");
}
else{
response.sendRedirect("Signin.html");
}

}
catch(Exception e){
out.println(e);
}

%>
