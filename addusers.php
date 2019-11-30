<?php
header('Location: users.php');
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    switch($_POST["role"]){
        case "Pupil":
            $role=0;
            break;
        case "Staff":
            $role=1;
            break;
        case "Admin":
            $role=2;
            break;   
    }
    $stmt = $conn->prepare("INSERT INTO user (UserID,Surname,Forename,Password,House,Role)VALUES (null,:surname,:forename,:password,:house,:role)");
            $stmt->bindParam(':forename', $_POST["forename"]);
            $stmt->bindParam(':surname', $_POST["surname"]);
            $stmt->bindParam(':house', $_POST["house"]);
            $stmt->bindParam(':password', $_POST["passwd"]);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            }
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>