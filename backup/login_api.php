<?php

    require_once 'connection.php';

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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

                    $response = array(
                        'status' => 'success',
                        'message' => 'Login successful'
                    );
                    echo json_encode($response);
                    exit;
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Invalid username or password'
                    );
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Invalid username or password'
                );
                echo json_encode($response);
                exit;
            }
        } else {
            // Error preparing the statement
            $error_message = $conn->error;
            error_log("Error: $error_message", 0); // Log the error message

            $response = array(
                'status' => 'error',
                'message' => 'Failed to prepare statement'
            );
            echo json_encode($response);
            exit;
        }
    }
?>
