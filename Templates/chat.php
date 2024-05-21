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