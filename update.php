<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>

<body>

    <?php
    require 'connect.php';
    if (isset($_GET['PID'])) {
        $stdate = $_GET["PID"];
        
        $query_select = 'SELECT * FROM product WHERE PID =:PID ';
        $stmt = $conn->prepare($query_select);
        $stmt->bindParam(':PID',$stdate );
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>อัปเดทข้อมูลสินค้า</h3>
                <form action="updateBD.php" method="POST">

                    <label for="PID">รหัสสินค้า:</label>
                    <input type="text" placeholder="PID" name="PID" required class="form-control" value="<?php echo isset($result['PID']) ? $result['PID'] : ''; ?>" readonly>
                    <br>
                    <label for="PName">ชื่อสินค้า:</label>
                    <input type="text" placeholder="PName" name="PName" required class="form-control" value="<?php echo isset($result['PName']) ? $result['PName'] : ''; ?>">
                    <br>
                    <label for="Price">ราคา:</label>
                    <input type="number" placeholder="Price" name="Price" required class="form-control" value="<?php echo isset($result['Price']) ? $result['Price'] : ''; ?>">
                    <br>
                    <br> <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('ยืนยันการแก้ไข');">อัปเดทข้อมูล</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>