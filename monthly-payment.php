<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'header.php';
include 'navbar.php';
include 'connection.php';

?>

<title>Monthly Payment</title>

<body>

    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded shadow">
            <h2 class="text-2xl mb-4">Transactions Monthly</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="trans_name" class="block text-gray-700 text-sm mb-2">Transactions Monthly</label>
                    <input id="trans_name" type="text" name="transac_name" min=0 class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <!-- <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm mb-2">Pay Date</label>
                    <input id="amount" type="datetime-local" name="pay_date" min=0 class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div> -->
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm mb-2">Amount</label>
                    <input id="amount" type="number" name="amount" min=0 class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <!-- <div class="mb-4">
                    <label for="account" class="block text-gray-700 text-sm mb-2">Account</label>
                    <select id="account" name="current_status" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option selected disabled>เลือก</option>
                        <option value="not-paid">Not Paid</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div> -->
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm mb-2">Remark</label>
                    <input id="amount" type="text" name="remark" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit" class="mt-4 w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
            </form>
        </div>
    </div>

    <?php
    // Include the connection.php file
    require_once 'connection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $transac_name = $_POST['transac_name'];
        // $pay_date = $_POST['pay_date'];
        $amount = $_POST['amount'];
        // $current_status = $_POST['current_status'];
        $remark = $_POST['remark'];

        // prepare statement to insert data
        $insertStmt = $conn->prepare("INSERT INTO monthly_payments (transac_name, amount, remark) VALUES (?, ?, ?)");
        if (!$insertStmt) {
            // Error preparing the statement
            echo "Prepare statement error: " . $conn->error;
            // Handle the error appropriately
        } else {
            $insertStmt->bind_param("sss", $transac_name, $amount, $remark);
            if (!$insertStmt->execute()) {
                // Error executing the statement
                echo "Execute statement error: " . $insertStmt->error;
                // Handle the error appropriately
            } else {
                // Successful insert and updates
                echo "<script>
                            swal('Success', 'บันทึกข้อมูลเรียบร้อย', 'success');
                            setTimeout(function() {
                            swal.close();
                            window.location.href = 'monthly-payment.php';
                    }, 1500);
                </script>";
            }
        }
    }
    ?>

</body>