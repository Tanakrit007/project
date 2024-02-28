<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>รายการสินค้า <a href="add_dropdown.php" class="btn btn-info float-end">+เพิ่มข้อมูลรายการสินค้า</a>
                </h3> <br />
                <table id="PatientTable" class="display table table-striped  table-hover table-responsive table-bordered ">

                    <thead align="center">
                        <tr>
                             <th width="10%">รหัสสินค้า</th>
                            <th width="10%">ประเภทสินค้า</th>
                            <th width="10%">ชื่อสินค้า</th>
                            <th width="10%">ราคา</th>
                            <th width="25%">ภาพสินค้า</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        require 'connect.php';
                        $sql = 'SELECT product.PID, product_type.PDTName, product.PName, product.Price, product.Image FROM product JOIN product_type ON product.PDTID = product_type.PDTID;';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        $stmt = $conn->prepare($sql);

                        foreach ($result as $r) { ?>
                            <tr>
                                <td>
                                    <?= $r['PID'] ?>
                                </td>
                                <td>
                                    <?= $r['PDTName'] ?>
                                </td>
                                <td>
                                    <?= $r['PName'] ?>
                                </td>
                                <td>
                                    <?= $r['Price'] ?>
                                </td>
                                
                                <td><img src="Image/<?php echo $r['Image']?>" width="50px" height="50" alt="Image" onclick="enlargeImg()" id="img1"></td>
                                <td><a href="update.php?PID=<?= $r['PID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="delete.php?PID=<?= $r['PID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#PatientTable').DataTable();
        });
    </script>
</body>

</html>