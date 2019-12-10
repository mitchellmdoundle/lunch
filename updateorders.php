<?php
header('Location: showorders.php');
print_r($_POST);
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    $stmt = $conn->prepare("UPDATE orders SET Complete=1 WHERE OrderID=:orderid");
    $stmt->bindParam(':orderid', $_POST["Orderid"]);    
    $stmt->execute();
} 
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>