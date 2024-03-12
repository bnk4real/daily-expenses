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
$sql = "SELECT * FROM monthly_payments";
$result = mysqli_query($conn, $sql);

?>

<title>Transfer History</title>

<body class="bg-gray-200">

    <div class="container mx-auto px-4">
        <h2 class="text-2xl mt-5 mb-4">Transfer Transactions</h2>
        <table id="transactionTable" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-100 font-medium">ID</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium">Trans Name</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium">Amount</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium">Pay Date</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium">Current Status</th>
                    <th class="py-2 px-4 bg-gray-100 font-medium">Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["id"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["transac_name"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo number_format($row["amount"], 2) ?></td>
                        <td class="py-4 px-6 border-b text-center">
                            <?php if ($row["pay_date"] == "") {
                                echo "ยังไม่ได้ระบุวันจ่าย";
                            } else {
                                echo "แสดงข้อมูลไม่ได้";
                            } ?>
                        </td>
                        <td class="py-4 px-6 border-b text-center">
                            <?php if ($row["current_status"] == "") {
                                echo "ยังไม่ได้ระบุสถานะ";
                            } else {
                                echo "แสดงข้อมูลไม่ได้";
                            } ?>
                        </td>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["remark"]?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>