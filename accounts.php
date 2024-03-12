<?php

    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit;
    }
    include 'header.php';
    include 'navbar.php';
    include 'connection.php';
    $sql = "SELECT * FROM accounts";
    $result = mysqli_query($conn, $sql);

?>

<title>Account List</title>

<body class="bg-gray-200">


    <div class="container mx-auto px-4">
        <h2 class="text-2xl mt-5 mb-4">Account Names</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-3 px-6 bg-gray-100 font-medium uppercase">Id</th>
                    <th class="py-3 px-6 bg-gray-100 font-medium uppercase">Account Name</th>
                    <th class="py-3 px-6 bg-gray-100 font-medium uppercase">Amount</th>
                    <th class="py-3 px-6 bg-gray-100 font-medium uppercase">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["id"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo $row["account_name"]; ?></td>
                        <td class="py-4 px-6 border-b text-center"><?php echo number_format($row["deposit_amount"], 2); ?></td>
                        <td class="py-4 px-6 border-b text-center">
                            <a href="edit-accounts.php?id=<?php echo $row["id"]; ?>" class="inline-block px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">แก้ไข</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center">
            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <h3 class="text-xl font-semibold mb-2">Total Net </h3>
                <h3 class="text-gray-600 text-xl">฿ <?php echo $total['total_amount']; ?></h3>
            </div>
        </div>
    </div>


</body>