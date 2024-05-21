<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/layout.css">
    <link rel="stylesheet" href="../Styles/view_course.css">
    <link rel="stylesheet" href="../Styles/landing.css">
    
    
  
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
    session_start() 
    ?>
    <nav class="first-nav">
    <a href="tp_dashboard.php">
            <h2>Gym System</h2>
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

<!-- Second Navigation Bar (new) -->
<nav class="second-nav">
    <div>
    <ul class = "nav-links">
    <li><a href="create_new_qfc_page.php">Create new QFC</a></li>
        <li><a href="quick_form_check.php">Active</a></li>
        <li><a href="quick_form_check_complete.php">Completed</a></li>
    </ul>
    </div>
    <div class="burger">
        <div class="l1"></div>
        <div class="l2"></div>
        <div class="l3"></div>
    </div>
</nav>
    <div class="all-content">
    <main>
    <h1>Active</h1>
        <div id="courses-container">
        <?php 
    $sql = "SELECT * FROM qfc WHERE user_id = '" . $_SESSION["id"] . "' AND qfc_status = 'active'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        ?>
       <a href="qfc.php?id=<?php echo $row['qfc_id']; ?>">
          <div class="course">
            <h5 class="course-name"><?php echo $row["qfc_id"]?></h5>
            <h5 class="course-name"><?php echo $row["qfc_type"]?></h5>
            <h5 class="course-name">status: <?php echo $row["qfc_status"] ?></h5>

        </div>
    </a>
    <?php  }
  } else {
      echo "No courses found.";
  }
    ?>
        </div>
   
        </div>
        
    </main>
    <footer>

    </footer>

    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
      </body>
</html>
