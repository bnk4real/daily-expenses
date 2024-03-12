<?php
// Include the necessary database connection file
require_once 'connection.php';

// Retrieve data from the database
$query = "SELECT * FROM accounts";
$result = mysqli_query($conn, $query);

// Define the path and filename for the CSV file
$csvFilePath = 'C:/laragon/www/daily-expenses/backup/cronjob_accounts.csv';

// Open the CSV file for writing
$file = fopen($csvFilePath, 'w');

// Write the column headers to the CSV file
$headers = ['ID', 'Account_Name', 'v']; // Replace with your actual column names
fputcsv($file, $headers);

// Write the data rows to the CSV file
while ($row = mysqli_fetch_assoc($result)) {
    $rowData = [$row['id'], $row['account_name'], $row['deposit_amount']]; // Replace with your actual column names
    fputcsv($file, $rowData);
}

// Close the CSV file
fclose($file);

// Close the database connection
mysqli_close($conn);
?>
