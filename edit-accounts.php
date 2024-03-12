<?php

    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit;
    }
    include 'header.php';
    include 'navbar.php';
    include 'connection.php';
    $accId = $_GET['id'];
    $sql = "SELECT * FROM accounts WHERE id = '$accId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result)
    
?>

<title>Account List</title>

<body class="bg-gray-200">


    <div class="container mx-auto px-4">
        <h2 class="text-2xl mb-4">แก้ไขข้อมูลบัญชี</h2>
        <div class="max-w-md w-full bg-white p-8 rounded shadow">
            <form method="POST" action="" class="grid grid-cols-2 gap-4">
                <div>
                    <label for="account_name" class="block mb-1 font-medium">Account Name :</label>
                    <input type="text" id="account_name" name="account_name" value="<?php echo $row['account_name'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div>
                    <label for="deposit_amount" class="block mb-1 font-medium">Deposit Amount :</label>
                    <input type="number" id="deposit_amount" name="deposit_amount" value="<?php echo $row['deposit_amount'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="col-span-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Include the connection.php file
    require_once 'connection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $account_name = $_POST['account_name'];
        $deposit_amount = $_POST['deposit_amount'];
        
        // Perform database insert operation
        $stmt = $conn->prepare("UPDATE accounts SET account_name = ?, deposit_amount = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sss", $account_name, $deposit_amount, $accId);
            if ($stmt->execute()) {
                // Successful insert
                echo "<script>
                    swal('Success', 'บันทึกข้อมูลเรียบร้อย', 'success');
                    setTimeout(function() {
                        swal.close();
                        window.location.href = 'accounts.php';
                    }, 3000); // 3 seconds
                </script>";
            } else {
                // Error occurred
                echo "<script>
                    swal('Error', 'Failed tp insert', 'error');
                    setTimeout(function() {
                        swal.close();
                        window.location.href = 'accounts.php';
                    }, 3000); // 3 seconds
                </script>";
            }
        } else {
            // Error preparing the statement
            echo "<script>
            swal('Error', 'Failed tp insert', 'error');
                setTimeout(function() {
                    swal.close();
                    window.location.href = 'accounts.php';
                }, 3000); // 3 seconds
            </script>";        
        }
    }
    ?>

</body>