<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to User</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1f1f3f;
            color: white;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #2d2d50;
        }
        .logo {
            width: 80px;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .hero {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            background: linear-gradient(to right, #1f1f3f, #4a4a8d);
        }
        .hero img {
            max-width: 700px;
            margin-right: 70px;
        }
        .hero .text {
            text-align: left;
        }
        .hero h1 {
            font-size: 3.5rem;
            color: white;
        }
        .hero p {
            font-size: 1.2rem;
            color: #d3d3d3;
            margin: 20px 0;
        }
        .btn {
            background-color: #ff4081;
            color: white;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            margin-right: 20px;
        }
        .btn:hover {
            background-color: #ff79a7;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #2d2d50;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <img src="image/APS.png" alt="Shopee Logo" class="logo">
    <nav>
        <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="#">Welcome, <?= htmlspecialchars($_SESSION['username']); ?></a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>


    <section class="hero">
        <img src="image/shopping.png" alt="Shopping Cart Illustration">
        <div class="text">
            <h1>Welcome User</h1>
            <p>Find the best deals with an easy and seamless experience.</p>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="btn">Login</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- <footer>
        <p>&copy; 2024 Shopee. All Rights Reserved.</p>
    </footer> -->

</body>
</html>
