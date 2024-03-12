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
$sql = "SELECT * FROM daily_expenses
        LEFT JOIN accounts ON daily_expenses.account_id = accounts.id 
        WHERE daily_expenses.create_date <= NOW()
        AND daily_expenses.trans_type_id = '002'
        ORDER BY daily_expenses.create_date DESC";
$result = mysqli_query($conn, $sql);

?>

<title>Expenses Transaction</title>

<body class="bg-gray-200">


    <div class="container mx-auto px-4">
        <h2 class="text-2xl mt-5 mb-4">Expenses Transactions</h2>
        <table id="transactionTable" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-100 font-medium uppercase">Date</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium uppercase">Transaction Name</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium uppercase">Amount</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium uppercase">Account Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["create_date"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["transaction_name"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo number_format($row["amount"], 2) ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["account_name"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</body>