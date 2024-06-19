<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/layout.css">
    <link rel="stylesheet" href="../Styles/landing.css">
    <link rel="stylesheet" href="../Styles/create_course.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/3704673904.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.css" />
<script src="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.js"></script>

    <title>Create Course</title>
</head>
<body>
    <?php 
    include 'db_conn.php';
    session_start(); 
?>
    <nav>
    <nav class="first-nav">
    <a href="member_dashboard.php">
            <h2>Pygmalion</h2>
        </a>
        <div>
            <ul class="nav-links">
                <li><a href="forum_feed.php">Forum</a></li>
                <li><a href="quick_form_check.php">Quick Form Check</a></li>
                <li><a href="#">Quiz</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Virtual competiton</a></li>
                <li><a href="#">recommended plan</a></li>
                <li><a href="#">Chat</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
            
        </div>
    <div class="burger">
        <div class="l1"></div>
        <div class="l2"></div>
        <div class="l3"></div>
    </div>
</nav>
<nav class="second-nav">
    <div>
    <ul class = "nav-links">
        <li><a href="create_new_qfc_page.php">Create new QFC</a></li>
        <li><a href="quick_form_check.php">Active</a></li>
        <li><a href="quick_form_check_complete.php">Completed</a></li>
    </div>
    <div class="burger">
        <div class="l1"></div>
        <div class="l2"></div>
        <div class="l3"></div>
    </div>
</nav>
        
        <div class="burger">
            <div class="l1"></div>
            <div class="l2"></div>
            <div class="l3"></div>
            
        </div>
    </nav>
    <div class="all-content">
    <main>

        <div id="create-course-form">
            <h2 id="create_course_headline">Create Course</h2>
        <form action="create_new_qfc.php" method="POST">
                <input type="text" class="input" id="qfc_title" name="qfc_title" placeholder="qfc title">
                <input type="text" class="input" id="qfc_url" name="qfc_url" placeholder="qfc url" required>
                <textarea class="input" id="qfc_description" name="qfc_description" rows="10" cols="50" placeholder="Description"></textarea>
                <select class ="input" name="qfc_type" id="qfc_type">
                    <option disabled selected>Type</option>
                    <option value="Cardio">Cardio</option> 
                    <option value="Weightlifting">Weightlifting</option> 
                    <option value="Nutrition">Nutrition</option> 
                </select>
                <input type="submit"  value="Submit" id="submit" />
                
               
            </form>
           
        </div>
        
    </main>
    <footer>

    </footer>
''
    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>