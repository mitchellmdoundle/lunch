<?php
header('Location: food.php');
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    switch($_POST["type"]){
        case "Sandwich":
            $type=0;
            break;
        case "Snack":
            $type=1;
            break;
        case "Drink":
            $type=2;
            break;   
    }
    $stmt = $conn->prepare("INSERT INTO food (FoodID,Type,Name)VALUES (null,:type,:name)");
            $stmt->bindParam(':name', $_POST["name"]);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
            }
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>