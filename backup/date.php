<?php
include('connection.php');
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM dates";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATE</title>
</head>

<body>


    <div class="form-floating mb-3">
        <label for="">เวลาเข้างาน :</label>
        <input type="time" name="checkin" class="form-control" placeholder="hh:mm:ss" value="<?php echo $row["checkin"]; ?>" required>
    </div>


</body>

</html>