<!DOCTYPE html>
<html>
<head>
<title>Users</title>
</head>
<body>
<form action="addusers.php" method="post">
  First name:<input type="text" name="forename"><br>
  Last name:<input type="text" name="surname"><br>
  Password:<input type="password" name="passwd"><br>
  House:<input type="text" name="house"><br>
  <input type="radio" name="role" value="Pupil" checked> Pupil<br>
  <input type="radio" name="role" value="Staff"> Staff<br>
  <input type="radio" name="role" value="Admin"> Admin<br>
  <input type="submit" value="Add User">
</form>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();
echo("<br>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo($row["UserID"].', '.$row["Forename"].' '.$row["Surname"].', '.$row["House"].', '.$row["Role"].', '.$row["Password"]."<br>");
}
?>
</body>
</html>
