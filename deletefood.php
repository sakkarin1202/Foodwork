<?php

if (isset($_GET['FoodID'])) {
    require 'connect.php';

    $query = "DELETE FROM food WHERE FoodID = :FoodID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':FoodID', $_GET['FoodID']);

    if ($stmt->execute()) {
        $mess = "Food Deleted!!!";
        header('location:index.php');
    } else {
        $mess = "Failed Delete!!!";
    }

    echo $mess;
    $conn = null;

}



?>


