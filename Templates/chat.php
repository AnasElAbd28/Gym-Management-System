<?php 
session_start();
include_once "db_conn.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Check if user_id is set and valid
if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    header("Location: users.php");
    exit();
}

$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

// Fetch user details
$sql = "SELECT * FROM user WHERE user_id = {$user_id}";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: users.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
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
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <div class="details">
          <span><?php echo htmlspecialchars($row['username']); ?></span>
          <p><?php echo htmlspecialchars($row['status']); ?></p>
        </div>
      </header>
      <div class="chat-box">
        <!-- Chat messages will go here -->
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($user_id); ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="../Javascript/chat.js"></script>
</body>
</html>