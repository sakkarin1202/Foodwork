<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<title>User Registration</title>
</head>
<body>


<?php
require 'connect.php';

$sql_select = 'SELECT * from foodtype order by FoodTypeID';
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();

if (isset($_POST['submit'])) {
    
    if (!empty($_POST['FoodID']) && !empty($_POST['FoodName'])) {
        //echo'countrycode'.$_POST['CountryCode'];
        //echo '<br>' . $_POST['CustomerID'];
        //require 'connect.php';

        $sql = "INSERT INTO food  VALUES (:FoodID, :FoodName, :FoodPrice, :FoodTypeID )";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':FoodID', $_POST['FoodID']);
        $stmt->bindParam(':FoodName',$_POST['FoodName']);
        $stmt->bindParam(':FoodPrice',$_POST['FoodPrice']);
        $stmt->bindParam(':FoodTypeID',$_POST['FoodTypeID']);
      
        

        try {
            if ($stmt->execute()):
                $message = 'Successfully add new food';
            else:
                $message = 'Fail to add new food';
            endif;
            echo $message;
        } catch (PDOException $e) {
            echo 'Fail! ' . $e;
        }

        $conn = null;
    }

    header("Location:index.php");
}
?>



    <div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
            <h3>ฟอร์มเพิ่มข้อมูลลูกค้า</h3>
            <form  action="addfood_dropdown.php" method="POST">

            <input type="text" placeholder="Enter Food ID" name="FoodID"> 
            <br> <br>
            <input type="text" placeholder="FoodName" name="FoodName">
            <br> <br>
            <input type="text" placeholder="FoodPrice" name="FoodPrice">
            <br> <br>
            <input type="text" placeholder="FoodTypeID" name="FoodTypeID">
            <br> <br>     
            <label>Select a FoodType</label>
                <select name="FoodTypeID">
                    <?php while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $cc['FoodTypeID']; ?>">
                            <?php echo $cc['FoodTypeName']; ?>
                        </option>
                    <?php } ?>
                </select>       
            <br> <br>

            <input type="submit" value="Submit" name="submit" />
            </form>
            </div>
        </div>
    </div>
</body>
</html>



