<?php
session_start();
require 'db.php'; // Make sure you have your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Check if the username already exists
    $stmt = $pdo->prepare("SELECT * FROM shopusers WHERE username = ?");
    if ($stmt->execute([$username])) {
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            $error = "Username already taken!";
        } else {
            // Prepare and execute the SQL statement for registration
            $stmt = $pdo->prepare("INSERT INTO shopusers (username, password, email, role) VALUES (?, ?, ?, 'user')");
            if ($stmt->execute([$username, $password, $email])) {
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'user'; // Default role

                // Redirect to a welcome or home page
                if ($user['role'] === 'admin') {
                    header("Location: users/shop.php");
                } else {
                    header("Location: users/shop.php");
                }
                exit();
            } else {
                $error = "Registration failed!";
            }
        }
    } else {
        $error = "Failed to check username availability!";
    }
}
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #1f1f3f, #4a4a8d);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .register-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            max-width: 320px;
            width: 100%;
        }
        h2 {
            color: white;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
            font-weight: bold;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }
        input {
            width: 80%;
            padding: 1rem;
            border: none;
            border-radius: 50px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 1rem;
            padding-left: 3rem;
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }
        button {
            background-color: white;
            color: #6a11cb;
            border: none;
            padding: 1rem;
            font-size: 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }
        button:hover {
            background-color: #f0f0f0;
        }
        .login {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        a {
            color: white;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST">
            <div class="input-group">
                <span class="input-icon">👤</span>
                <input type="text" name="username" required placeholder="Username">
            </div>
            <div class="input-group">
                <span class="input-icon">✉️</span>
                <input type="email" name="email" required placeholder="Email">
            </div>
            <div class="input-group">
                <span class="input-icon">🔒</span>
                <input type="password" name="password" required placeholder="Password">
            </div>
            <button type="submit">Register</button>
        </form>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <div class="login">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>
