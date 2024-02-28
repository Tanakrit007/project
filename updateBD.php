<?php

    try 

        if (isset($_POST['FoodID']) && isset($_POST['FoodName'])) :
            // echo "<br>" . $_POST['customerID'] . $_POST['Name'] . $_POST['birthdate'] . $_POST['email'] .
            //     $_POST['countryCode'] . $_POST['outstandingDebt'];

            require 'connect.php';
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE product SET 
            PName = :PName,
            Price = :Price,
            Image = :Image
            WHERE 
            PID = :PID';

            $stmt->bindParam(':PID', $_POST['PID']);
            $stmt->bindParam(':PName', $_POST['PName']);
            $stmt->bindParam(':Price', $_POST['Price']);
            $stmt->bindParam(':Image', $_POST['Image']);
            if ($stmt->execute()) :
                $message = '<div class="alert alert-success" role="alert">Successfully updated customer</div>';
            else :
                $message = '<div class="alert alert-danger" role="alert">Fail to update customer</div>';
            endif;
            echo $message;

            $conn = null;
        endif;
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
    }
    ?>