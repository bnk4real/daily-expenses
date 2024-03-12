<?php
session_start();
include 'header.php';
?>

<title>Login Page</title>

<body class="bg-gray-200">
    
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded shadow">
            <h2 class="text-2xl mb-4">Login</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm mb-2">Username</label>
                    <input id="username" type="text" name="username" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm mb-2">Password</label>
                    <input id="password" type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <button type="submit" class="mt-4 w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Login</button>
            </form>
        </div>
    </div>

    <?php
    include 'connection.php';
    date_default_timezone_set('Asia/Bangkok');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Retrieve the encrypted password and last_login from the database
        $stmt = $conn->prepare("SELECT password, last_login FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashedPassword, $lastLogin);
                $stmt->fetch();
                // Verify the entered password against the stored hashed password
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['username'] = $username;
                    // Update the last_login field in the database
                    $current_time = date("Y-m-d H:i:s");
                    $updateStmt = $conn->prepare("UPDATE users SET last_login = ? WHERE username = ?");
                    if ($updateStmt) {
                        $updateStmt->bind_param("ss", $current_time, $username);
                        $updateStmt->execute();
                        $updateStmt->close();
                    }
                    echo "<script>
                            swal('Success Login', 'Welcome!', 'success');
                            setTimeout(function() {
                                swal.close();
                                window.location.href = 'main.php';
                            }, 1000);
                        </script>";
                    exit;
                } else {
                    echo "<script>
                            swal('Warning', 'Invalid username or password!', 'error');
                            setTimeout(function() {
                                swal.close();
                                window.location.href = 'login.php';
                            }, 1500);
                        </script>";
                    exit;
                }
            } else {
                echo "<script>
                        swal('Warning', 'Invalid username or password!', 'error');
                        setTimeout(function() {
                            swal.close();
                            window.location.href = 'login.php';
                        }, 1500);
                    </script>";
                exit;
            }
        } else {
            // Error preparing the statement
            $error_message = $conn->error;
            error_log("Error: $error_message", 0); // Log the error message
            echo "<script>
                    swal('Error', 'Failed to prepare statement', 'error');
                    setTimeout(function() {
                        swal.close();
                        window.location.href = 'login.php';
                    }, 1500);
                </script>";
            exit;
        }
    }
?>

</body>