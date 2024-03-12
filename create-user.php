<?php
// session_start();
// if (!isset($_SESSION['username'])) {
//     header('Location: login.php');
//     exit;
// }
include 'header.php';
include 'navbar.php';
include 'connection.php';
?>

<title>Create New Bank Account</title>

<body class="bg-gray-200">

    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded shadow">
            <h2 class="text-2xl mb-4">Create new user</h2>
            <form method="POST" action="" class="grid grid-cols-2 gap-4">
                <div>
                    <label for="username" class="block mb-1 font-medium">Username :</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div>
                    <label for="password" class="block mb-1 font-medium">Password :</label>
                    <input type="text" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="col-span-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Include the connection.php file
    require_once 'connection.php';

    function encryptPassword($password)
    {
        // Hash the password using bcrypt algorithm
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $hashedPassword;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        date_default_timezone_set('Asia/Bangkok');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $encryptedPassword = encryptPassword($password);
        $current_time = date("Y-m-d H:i:s");
        // print  $current_time;

        // Perform database insert operation
        $stmt = $conn->prepare("INSERT INTO users (username, password, create_date, last_login) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $username, $encryptedPassword, $current_time, $current_time);
            if ($stmt->execute()) {
                // Successful insert
                echo "<script>
                        swal('Success', 'บันทึกข้อมูลเรียบร้อย', 'success');
                        setTimeout(function() {
                            swal.close();
                            window.location.href = 'main.php';
                        }, 1500); // 3 seconds
                    </script>";
            } else {
                // Error occurred
                $error_message = $stmt->error;
                error_log("Error: $error_message", 0); // Log the error message
                echo "<script>
                        swal('Error', 'Failed to insert data', 'error');
                        setTimeout(function() {
                            swal.close();
                            window.location.href = 'accounts.php';
                        }, 1500); // 3 seconds
                </script>";
            }
        } else {
            // Error occurred
            // $error_message = $stmt->error;
            error_log("Error: $error_message", 0); // Log the error message
            echo "<script>
                    swal('Error', 'Failed to insert data', 'error');
                    setTimeout(function() {
                        swal.close();
                        window.location.href = 'accounts.php';
                    }, 1500); // 3 seconds
            </script>";
        }
    }
    ?>



</body>