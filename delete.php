<?php

require('connect.php');

if(isset($_GET["PID"])) {
    $strFoodID = $_GET["PID"];
    $sql = "DELETE FROM product WHERE PID = ?";
    $params = array($strFoodID); 
    $stml = $conn->prepare($sql);

    if ($stml->execute($params)) {
        $message = "Successfully delete Foof ".$_GET['PID'].".";
    } else {
        $message = "Fail to delete Food information.";
    }
} else {
    $message = "FoodIDnot provided.";
}

$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body>

<script>
    $(document).ready(function(){
        swal({
            title: "<?php echo $message; ?>",
            icon: "info",
            buttons: false,
            timer: 2000 // Close the alert after 2 seconds
        });

        // Optionally, you can remove the deleted customer's row from the page
        // Uncomment the following lines if you want to remove the row without refreshing the page
        // $("#customerRow_<?php echo $_GET['PID']; ?>").remove();
    });
</script>

</body>
</html>