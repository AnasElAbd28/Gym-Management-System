<?php 
  session_start();
  include_once "db_conn.php";
  if(!isset($_SESSION['id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
<nav class="first-nav">
<a href="member_dashboard.php">
            <h2>Pygmalion</h2>
        </a>
        <div>
            <ul class="nav-links">
                <li><a href="forum_feed.php">Forum</a></li>
                <li><a href="quick_form_check.php">Quick Form Check</a></li>
                <li><a href="quizzes_page.php">Quiz</a></li>
                <li><a href="schedule_plan.php">Schedule</a></li>
                <li><a href="recommended_plan.php">recommended plan</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="profile.php">Profile</a></li>
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
        <ul class="nav-links">
            <li><a href="schedule_plan.php">Monday</a></li>
            <li><a href="tuesday.php">Tuesday</a></li>
            <li><a href="wednesday.php">Wednesday</a></li>
            <li><a href="thursday.php">Thursday</a></li>
            <li><a href="friday.php">Friday</a></li>
            <li><a href="saturday.php">Saturday</a></li>
            <li><a href="sunday.php">Sunday</a></li>
        </ul>
    </div>
    <div class="burger">
        <div class="l1"></div>
        <div class="l2"></div>
        <div class="l3"></div>
    </div>
</nav>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM user WHERE user_id = {$_SESSION['id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          
          <div class="details">
            <span><?php echo $row['username']; ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="logout.php" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="../Javascript/users.js"></script>
  <script src="../Javascript/app.js"></script>
  <script src="../Javascript/landing.js"></script>

</body>
</html>
