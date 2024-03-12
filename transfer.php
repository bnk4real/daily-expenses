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

<title>Transfer</title>

<body class="bg-gray-200">

    <!-- Impl Logic Backend :
        - Transfer from one account to another
        - Insert transaction record to database
        - Update original account amount 
        - Update destination account amount
    -->

    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded shadow">
            <h2 class="text-2xl mb-4">Transfer to another account</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <?php
                    $account = "SELECT * FROM accounts";
                    $result_query = mysqli_query($conn, $account);
                    ?>
                    <label for="account" class="block text-gray-700 text-sm mb-2">Account</label>
                    <select id="account" name="account_name_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option selected disabled>เลือกบัญชี</option>
                        <?php while ($row = mysqli_fetch_assoc($result_query)) { ?>
                            <option value="<?= $row["id"]; ?>"> <?php echo $row["account_name"]; ?></option>
                        <?php } ?>
                    </select>
                    <?php
                    $account = "SELECT * FROM accounts";
                    $result_query = mysqli_query($conn, $account);
                    ?>
                    <label for="account" class="block text-gray-700 text-sm mb-2">Account</label>
                    <select id="account" name="account_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option selected disabled>เลือกบัญชี</option>
                        <?php while ($row = mysqli_fetch_assoc($result_query)) { ?>
                            <option value="<?= $row["id"]; ?>"> <?php echo $row["account_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm mb-2">Amount</label>
                    <input id="amount" type="number" name="amount" min=0 class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
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
        $account_name_id = $_POST['account_name_id'];
        $amount = $_POST['amount'];
        $account_id = $_POST['account_id'];

        // check balances from original account 
        $sql = "SELECT deposit_amount FROM accounts WHERE id = ?";
        $checkStmt = $conn->prepare($sql);
        $checkStmt->bind_param("s", $account_name_id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $checkBalances = $checkResult->fetch_assoc();

        if ($amount <= 0) {
            echo "<script>
                    swal('Warning', 'จำนวนเงินที่โอนต้องมากกว่า 0', 'error');
                    setTimeout(function() {
                        swal.close();
                        window.location.href = 'transfer.php';
                    }, 1500);
            </script>";
        } elseif ($amount > $checkBalances['deposit_amount']) {
            echo "<script>
                    swal('Warning', 'จำนวนเงินไม่พอกับการโอน', 'error');
                    setTimeout(function() {
                        swal.close();
                        window.location.href = 'transfer.php';
                    }, 1500);
            </script>";
        } else {
            // prepare statement to insert data
            $insertStmt = $conn->prepare("INSERT INTO transfer_transaction (account_name_id, to_account_id, amount) VALUES (?, ?, ?)");
            if (!$insertStmt) {
                // Error preparing the statement
                echo "Prepare statement error: " . $conn->error;
                // Handle the error appropriately
            } else {
                $insertStmt->bind_param("sss", $account_name_id, $account_id, $amount);
                if (!$insertStmt->execute()) {
                    // Error executing the statement
                    echo "Execute statement error: " . $insertStmt->error;
                    // Handle the error appropriately
                } else {
                    // prepare statement to update amount from the original account
                    $updateFromStmt = $conn->prepare("UPDATE accounts SET deposit_amount = deposit_amount - ? WHERE id = ?");
                    if (!$updateFromStmt) {
                        // Error preparing the statement
                        echo "Prepare statement error: " . $conn->error;
                        // Handle the error appropriately
                    } else {
                        $updateFromStmt->bind_param("ss", $amount, $account_name_id);
                        if (!$updateFromStmt->execute()) {
                            // Error executing the statement
                            echo "Execute statement error: " . $updateFromStmt->error;
                            // Handle the error appropriately
                        } else {
                            // prepare statement to update amount in the destination account
                            $updateToStmt = $conn->prepare("UPDATE accounts SET deposit_amount = deposit_amount + ? WHERE id = ?");
                            if (!$updateToStmt) {
                                // Error preparing the statement
                                echo "Prepare statement error: " . $conn->error;
                                // Handle the error appropriately
                            } else {
                                $updateToStmt->bind_param("ss", $amount, $account_id);
                                if (!$updateToStmt->execute()) {
                                    // Error executing the statement
                                    echo "Execute statement error: " . $updateToStmt->error;
                                    // Handle the error appropriately
                                } else {
                                    if ($updateToStmt->affected_rows > 0) {
                                        // Successful insert and updates
                                        echo "<script>
                                                swal('Success', 'โอนเงินเรียบร้อย', 'success');
                                                setTimeout(function() {
                                                    swal.close();
                                                    window.location.href = 'accounts.php';
                                                }, 1500);
                                        </script>";
                                    } else {
                                        // Error occurred
                                        echo "<script>
                                                swal('Error', 'Failed to insert data', 'error');
                                                setTimeout(function() {
                                                    swal.close();
                                                    window.location.href = 'accounts.php';
                                                }, 1500); 
                                        </script>";
                                    }
                                }
                                $updateToStmt->close();
                            }
                        }
                        $updateFromStmt->close();
                    }
                }
                $insertStmt->close();
            }
        }
    }
    ?>

</body>