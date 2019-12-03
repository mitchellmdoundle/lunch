<?php
header("Refresh:5; url= order.php");
print_r($_POST);
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    $stmt = $conn->prepare("INSERT INTO basket(OrderID,SandwichID,SnackID,Sausage,DrinkID)VALUES (null,:sandwich,:snack,:sausage,:drink)");
    $stmt->bindParam(':sandwich', $_POST["sandwich"]);
    $stmt->bindParam(':sausage', $_POST["sausage"]);
    $stmt->bindParam(':snack', $_POST["snack"]);
    $stmt->bindParam(':drink', $_POST["drink"]);
            $stmt->execute();
            }
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>