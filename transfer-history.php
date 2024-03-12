<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include 'header.php';
include 'navbar.php';
include 'connection.php';
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM accounts
        RIGHT JOIN transfer_transaction 
        ON accounts.id = transfer_transaction.account_name_id";
$result = mysqli_query($conn, $sql);

?>

<title>Transfer History</title>

<body class="bg-gray-200">

    <div class="container mx-auto px-4">
        <h2 class="text-2xl mt-5 mb-4">Transfer Transactions</h2>
        <table id="transactionTable" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-100 font-medium">Account ID</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium">From Account Name</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium">Transfer Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["account_name_id"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["account_name"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo number_format($row["amount"], 2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>