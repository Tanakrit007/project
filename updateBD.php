<?php
try {
    if (isset($_POST['PID']) && isset($_POST['PName'])) {

        require 'connect.php';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE product SET 
            PName = :PName,
            Price = :Price
            WHERE
            PID = :PID";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':PID', $_POST['PID']);
        $stmt->bindParam(':PName', $_POST['PName']);
        $stmt->bindParam(':Price', $_POST['Price']);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success" role="alert">Successfully updated customer</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">Fail to update customer</div>';
        }
        echo $message;

        $conn = null;
    }
} catch (PDOException $e) {
    echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
}
?>
