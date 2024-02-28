<?php
    require "connect.php";
    $sql_select = 'SELECT * from product_type order by PDTID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();
    ?>
<DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>User Registration 265</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            color: #007bff;
        }

        form {
            max-width: 500px;
            margin: auto;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_POST['submit'])) {
        require 'connect.php';
            {
                $uploadFile = $_FILES['Image']['name'];
                $tmpFile = $_FILES['Image']['tmp_name'];
                $targetDirectory = "../image/"; 
                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }
            
                $fullpath = $targetDirectory . $uploadFile;
                
                move_uploaded_file($tmpFile, $fullpath);

            $sql = "INSERT INTO product (PID, PDTID, PName, Price, Image)
                    VALUES (:PID, :PDTID, :PName, :Price,  :Image)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':PID', $_POST['PID']);
            $stmt->bindParam(':PName', $_POST['PName']);
            $stmt->bindParam(':Price', $_POST['Price']);
            $stmt->bindParam(':PDTID', $_POST['PDTID']);
            $stmt->bindParam(':Image', $uploadFile);

            try {
                if ($stmt->execute()) :
    ?>
                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                    <script type="text/javascript">
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault(); // ป้องกันการโหลดหน้าใหม่หลังจากกด Submit

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response,
                        type: "success",
                        timer: 2500,
                        showConfirmButton: false
                    }, function() {
                        window.location.href = "index.php";
                    });
                },
                error: function(xhr, status, error) {
                    swal({
                        title: "Error!",
                        text: xhr.responseText,
                        type: "error",
                        timer: 2500,
                        showConfirmButton: false
                    });
                }
            });
        });
    });
</script>
    <?php
                else :
                    $message = 'Fail to add new Food';
                    echo $message;
                endif;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }
            $conn = null;
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <br>
                <h3>ฟอร์มเพิ่มข้อมูลสินค้า</h3>
                <form action="add_dropdown.php" method="POST" enctype="multipart/form-data">
                    <input type="text" placeholder="PID" name="PID"><br><br>
                    <input type="text" placeholder="PName" name="PName" required><br><br>
                    <input type="number" placeholder="Price" name="Price"><br><br>
                    <label>Select a PDTID</label>
                    <select name="PDTID">
                        <?php
                        while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <option value="<?php echo $cc['PDTID']; ?>">
                                <?php echo $cc['PDTName']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select><br><br>
                    แนบรูปภาพ:
                    <input type="file" name="Image" id="Image" required><br><br>
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable();
        });
    </script>
</body>

</html>