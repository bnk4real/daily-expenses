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

<title>Main Page</title>

<body class="bg-gray-200">

    <div class="container mx-auto mt-5" style="margin-top: 100px;">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts WHERE account_name = 'Bualuang Bank'";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <img src="images/bbl_jpg.jpg" alt="User Icon" class="w-12 h-12 mx-auto mb-4 rounded-full">
                <h3 class="text-xl font-semibold mb-2">Bualuang Bank Account</h3>
                <p class="text-gray-600 text-lg">฿ <?php echo number_format($total['total_amount'], 2); ?></p>
            </div>

            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts WHERE account_name = 'KBank'";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <img src="images/kplus.png" alt="Sales Icon" class="w-12 h-12 mx-auto mb-4 rounded-full">
                <h3 class="text-xl font-semibold mb-2">KBank Account</h3>
                <p class="text-gray-600 text-lg">฿ <?php echo number_format($total['total_amount'], 2); ?></p>
            </div>

            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts WHERE account_name = 'SCB'";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <img src="images/scb.png" alt="Orders Icon" class="w-12 h-12 mx-auto mb-4 rounded-full">
                <h3 class="text-xl font-semibold mb-2">SCB Account</h3>
                <p class="text-gray-600 text-lg">฿ <?php echo number_format($total['total_amount'], 2); ?></p>
            </div>

            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts WHERE account_name = 'True Money Wallet'";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <img src="images/True-Wallet.jpg" alt="Customers Icon" class="w-12 h-12 mx-auto mb-4 rounded-full">
                <h3 class="text-xl font-semibold mb-2">True Money Wallet</h3>
                <p class="text-gray-600 text-lg">฿ <?php echo number_format($total['total_amount'], 2); ?></p>
            </div>

            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts WHERE account_name = 'KTB'";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <img src="images/ktb_01.png" alt="Traffic Icon" class="w-12 h-12 mx-auto mb-4 rounded-full">
                <h3 class="text-xl font-semibold mb-2">KTB Account</h3>
                <p class="text-gray-600 text-lg">฿ <?php echo number_format($total['total_amount'], 2); ?></p>
            </div>

            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts WHERE account_name = 'TTB'";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <img src="images/ttb.png" alt="Traffic Icon" class="w-12 h-12 mx-auto mb-4 ">
                <h3 class="text-xl font-semibold mb-2">TTB Account</h3>
                <p class="text-gray-600 text-lg">฿ <?php echo number_format($total['total_amount'], 2); ?></p>
            </div>

            <?php 
                $sum = "SELECT SUM(deposit_amount) AS total_amount FROM accounts WHERE account_name = 'Cash'";
                $resTotal = mysqli_query($conn, $sum);
                $total = mysqli_fetch_assoc($resTotal);
                $total_amount = $total['total_amount'];
            ?>
            <div class="bg-white p-6 shadow-md rounded-md">
                <img src="images/cash.png" alt="Traffic Icon" class="w-12 h-12 mx-auto mb-4 ">
                <h3 class="text-xl font-semibold mb-2">Cash</h3>
                <p class="text-gray-600 text-lg">฿ <?php echo number_format($total['total_amount'], 2); ?></p>
            </div>
        </div>
    </div>



</body>