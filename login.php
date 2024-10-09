<?php
session_start();
require 'db.php'; // Make sure you have your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM shopusers WHERE username = ?");
    if ($stmt->execute([$username])) {
        $user = $stmt->fetch();

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: users/shop.php");
            } else {
                header("Location: users/shop.php");
            }
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .login-container {
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
        .error {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="input-group">
                <span class="input-icon">👤</span>
                <input type="text" name="username" required placeholder="Username">
            </div>
            <div class="input-group">
                <span class="input-icon">🔒</span>
                <input type="password" name="password" required placeholder="Password">
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="login">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>
</body>
</html>
