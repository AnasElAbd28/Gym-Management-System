<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/login.css">
    <link rel="stylesheet" href="../Styles/layout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <title>Login Page</title>
</head>
<body>
    <nav>
        <a href="#">
            <h2>TPMS</h2>
        </a>
        <div>
            <ul class="nav-links">
                <li><a href="AboutUs.php">About us</a></li>
            </ul>
        </div>
        
        
        <div class="burger">
            <div class="l1"></div>
            <div class="l2"></div>
            <div class="l3"></div>
            
        </div>
    </nav>
    <div class="all-content">
    <section id="text-sec">
        <p id="login-text">Login to your account</p>
        <p id="promotion">Training Provider Login</p>
    </section>
    <main>
        <div id="main-content">
        
        <section id="form-sec">
            <form action="tp_login.php" method="POST">
                <input type="email" class="input" id="email" name="Email" placeholder="test@email.com" >
                <input type="password" class="input" id="password" name="Password" placeholder="Enter your password" >
                <input type="submit"  value="Submit" id="submit" />
                <p>If you are an Student. Click here <a href="login_page.php">Student</a></p>
                <p>If you are an Instructor. Click here <a href="instructor_login_page.php">Instructor</a></p>
                
            </form>
        </section>
    </div>
    <div id="logo">
        <h2 id="logo-header">TPMS</h2>
        <p id="motto">We Strive for Excellence</p>
    </div>
    </main>
</div>
    <footer>

    </footer>

    <script src="../Javascript/app.js"></script>
</body>
</html>