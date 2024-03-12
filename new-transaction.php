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

<title>New Transaction</title>

<body class="bg-gray-200">

    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded shadow">
            <h2 class="text-2xl mb-4">Daily Expense</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="datetime" class="block text-gray-700 text-sm mb-2">Date and Time</label>
                    <input id="datetime" type="datetime-local" name="create_date" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm mb-2">Transaction Name</label>
                    <input id="name" type="text" name="transaction_name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm mb-2">Amount</label>
                    <input id="amount" type="number" name="amount" min=0 class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="account" class="block text-gray-700 text-sm mb-2">Trans Type</label>
                    <select id="account" name="trans_type_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option selected disabled>ประเภท</option>
                        <option value="001">Income</option>
                        <option value="002">Expenses</option>
                    </select>
                </div>
                <div class="mb-4">
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
                <button type="submit" class="mt-4 w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
            </form>
        </div>
    </div>

    <?php
    mysqli_set_charset($conn, "utf8");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $create_date = $_POST['create_date'];
        $transaction_name = $_POST['transaction_name'];
        $amount = $_POST['amount'];
        $transTypeId = $_POST['trans_type_id'];
        $accountId = $_POST['account_id'];

        // // Mapping account id
        $qAcc = "SELECT * FROM accounts WHERE id = '$accountId'";
        $getAccId = mysqli_query($conn, $qAcc);
        $account_id = mysqli_fetch_assoc($getAccId);

        // // Check balance
        // // TODO
        // if ($account_id['deposit_amount'] <= $amount) {
        //     echo "<script>
        //     swal('Error', 'จำนวนเงินในบัญชีไม่พอ', 'error');
        //     setTimeout(function() {
        //         swal.close();
        //         window.location.href = 'transactions.php';
        //     }, 2000);
        //   </script>";
        // }

        // Perform database insert operation
        $stmt = $conn->prepare("INSERT INTO daily_expenses (create_date, transaction_name, amount, trans_type_id, account_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $create_date, $transaction_name, $amount, $transTypeId, $accountId);

        if ($stmt->execute()) {
            if ($transTypeId == "001") {
                if ($accountId == $account_id['id']) {
                    $stmt_update = $conn->prepare($update = "UPDATE accounts SET deposit_amount = deposit_amount + ? WHERE id = ?");
                    $stmt_update->bind_param("ss", $amount, $accountId);
                    if ($stmt_update->execute()) {
                        echo "<script>
                             swal('Success', 'บันทึกข้อมูลเรียบร้อย', 'success');
                             setTimeout(function() {
                                 swal.close();
                                 window.location.href = 'transactions.php';
                             }, 1500); // 3 seconds
                        </script>";
                    } else {
                        echo "<script>
                            swal('Error', 'Fail to Insert', 'error');
                            setTimeout(function() {
                                swal.close();
                            }, 1500); // 3 seconds
                        </script>";
                    }
                } else {
                    echo "<script>
                        swal('Error', 'Fail to Insert', 'error');
                        setTimeout(function() {
                            swal.close();
                        }, 1500); // 3 seconds
                    </script>";
                }
            } else if ($transTypeId == "002") {
                if ($accountId == $account_id['id']) {
                    $stmt_update = $conn->prepare($update = "UPDATE accounts SET deposit_amount = deposit_amount - ? WHERE id = ?");
                    $stmt_update->bind_param("ss", $amount, $accountId);
                    if ($stmt_update->execute()) {
                        echo "<script>
                             swal('Success', 'บันทึกข้อมูลเรียบร้อย', 'success');
                             setTimeout(function() {
                                 swal.close();
                                 window.location.href = 'transactions.php';
                             }, 1500); // 3 seconds
                        </script>";
                    } else {
                        echo "<script>
                            swal('Error', 'Fail to Insert', 'error');
                            setTimeout(function() {
                                swal.close();
                            }, 1500); // 3 seconds
                        </script>";
                    }
                } else {
                    echo "<script>
                        swal('Error', 'Fail to Insert', 'error');
                        setTimeout(function() {
                            swal.close();
                        }, 1500); // 3 seconds
                    </script>";
                }
            }
        }
    }
    ?>


</body>