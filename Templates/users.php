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
            <?php if ($_SESSION['type'] === 'member'): ?>
                <li><a href="forum_feed.php">Forum</a></li>
                <li><a href="quick_form_check.php">Quick Form Check</a></li>
                <li><a href="quizzes_page.php">Quiz</a></li>
                <li><a href="schedule_plan.php">Schedule</a></li>
                <li><a href="recommended_plan.php">Recommended Plan</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php elseif ($_SESSION['type'] === 'trainer'): ?>
                <li><a href="quick_form_check.php">Quick Form Check</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
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
