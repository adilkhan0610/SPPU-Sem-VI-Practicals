<%@ page contentType="text/html" pageEncoding="UTF-8" %>

<!DOCTYPE html>
<html>

<head>
<title>Login Page</title>
</head>

<body style="font-family: Arial; background:#f4f4f4; text-align:center;">

<h2 style="margin-top:30px;">Login</h2>

<form action="loginform.do"
method="post"
style="background:white;
padding:20px;
width:300px;
margin:auto;
border-radius:10px;
box-shadow:0 0 10px gray;">

Username:<br>

<input type="text"
name="uname"
style="width:90%;padding:5px;">

<br><br>

Password:<br>

<input type="password"
name="upass"
style="width:90%;padding:5px;">

<br><br>

<input type="submit"
value="Login"
style="padding:8px 15px;
background:MediumSeaGreen;
color:white;
border:none;
border-radius:5px;">

</form>

</body>
</html>
