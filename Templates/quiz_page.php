<!DOCTYPE html>
<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['id'];

// Get the quiz_id from the URL
$quiz_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the quiz details
$quiz_query = "SELECT quiz_title, quiz_description FROM quizzes WHERE quiz_id = ?";
$quiz_stmt = $conn->prepare($quiz_query);
$quiz_stmt->bind_param("i", $quiz_id);
$quiz_stmt->execute();
$quiz_result = $quiz_stmt->get_result();
$quiz = $quiz_result->fetch_assoc();

// Fetch the questions and their options
$questions_query = "
    SELECT q.question_id, q.question_text, o.option_id, o.option_text, o.is_correct
    FROM questions q
    JOIN options o ON q.question_id = o.question_id
    WHERE q.quiz_id = ?
";
$questions_stmt = $conn->prepare($questions_query);
$questions_stmt->bind_param("i", $quiz_id);
$questions_stmt->execute();
$questions_result = $questions_stmt->get_result();

$questions = [];
while ($row = $questions_result->fetch_assoc()) {
    $questions[$row['question_id']]['question_text'] = $row['question_text'];
    $questions[$row['question_id']]['options'][] = [
        'option_id' => $row['option_id'],
        'option_text' => $row['option_text'],
        'is_correct' => $row['is_correct']
    ];
}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/3704673904.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.css" />
 <!-- Include Chart.js -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.js"></script>
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet'>
  <link href='' rel='stylesheet'>
  <style>
    

    label.btn {
      padding: 18px 60px;
      white-space: normal;
      -webkit-transform: scale(1.0);
      -moz-transform: scale(1.0);
      -o-transform: scale(1.0);
      -webkit-transition-duration: .3s;
      -moz-transition-duration: .3s;
      -o-transition-duration: .3s
    }

    label.btn:hover {
      text-shadow: 0 3px 2px rgba(0, 0, 0, 0.4);
      -webkit-transform: scale(1.1);
      -moz-transform: scale(1.1);
      -o-transform: scale(1.1);
    }

    label.btn-block {
      text-align: left;
      position: relative
    }

    label .btn-label {
      position: absolute;
      left: 0;
      top: 0;
      display: inline-block;
      padding: 0 10px;
      background: #49548b;
      height: 100%
    }

    label .glyphicon {
      top: 34%
    }

    .element-animation1 {
      animation: animationFrames ease .8s;
      animation-iteration-count: 1;
      transform-origin: 50% 50%;
      -webkit-animation: animationFrames ease .8s;
      -webkit-animation-iteration-count: 1;
      -webkit-transform-origin: 50% 50%;
      -ms-animation: animationFrames ease .8s;
      -ms-animation-iteration-count: 1;
      -ms-transform-origin: 50% 50%
    }

    .element-animation2 {
      animation: animationFrames ease 1s;
      animation-iteration-count: 1;
      transform-origin: 50% 50%;
      -webkit-animation: animationFrames ease 1s;
      -webkit-animation-iteration-count: 1;
      -webkit-transform-origin: 50% 50%;
      -ms-animation: animationFrames ease 1s;
      -ms-animation-iteration-count: 1;
      -ms-transform-origin: 50% 50%
    }

    .element-animation3 {
      animation: animationFrames ease 1.2s;
      animation-iteration-count: 1;
      transform-origin: 50% 50%;
      -webkit-animation: animationFrames ease 1.2s;
      -webkit-animation-iteration-count: 1;
      -webkit-transform-origin: 50% 50%;
      -ms-animation: animationFrames ease 1.2s;
      -ms-animation-iteration-count: 1;
      -ms-transform-origin: 50% 50%
    }

    .element-animation4 {
      animation: animationFrames ease 1.4s;
      animation-iteration-count: 1;
      transform-origin: 50% 50%;
      -webkit-animation: animationFrames ease 1.4s;
      -webkit-animation-iteration-count: 1;
      -webkit-transform-origin: 50% 50%;
      -ms-animation: animationFrames ease 1.4s;
      -ms-animation-iteration-count: 1;
      -ms-transform-origin: 50% 50%
    }

    @keyframes animationFrames {
      0% {
        opacity: 0;
        transform: translate(-1500px, 0px)
      }

      60% {
        opacity: 1;
        transform: translate(30px, 0px)
      }

      80% {
        transform: translate(-10px, 0px)
      }

      100% {
        opacity: 1;
        transform: translate(0px, 0px)
      }
    }

    @-webkit-keyframes animationFrames {
      0% {
        opacity: 0;
        -webkit-transform: translate(-1500px, 0px)
      }

      60% {
        opacity: 1;
        -webkit-transform: translate(30px, 0px)
      }

      80% {
        -webkit-transform: translate(-10px, 0px)
      }

      100% {
        opacity: 1;
        -webkit-transform: translate(0px, 0px)
      }
    }

    

    .modal-body {
      min-height: 300px
    }
  </style>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
  <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
  <link rel="stylesheet" href="../Styles/layout.css">
  <link rel="stylesheet" href="../Styles/landing.css">
    <link rel="stylesheet" href="../Styles/member_dashboard_style.css">
    <title>Dashboard</title>
</head>
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
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Virtual competiton</a></li>
                <li><a href="#">recommended plan</a></li>
                <li><a href="chat.php">Chat</a></li>
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
    <div class="all-content">
    <main>
    <form method="POST" action="quiz_attempt.php?id=<?php echo $quiz_id; ?>">
                <?php foreach ($questions as $question_id => $question): ?>  
                    <div class="container-fluid">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 style="color: black;">Q. <?php echo htmlspecialchars($question['question_text']); ?></h3>
                                </div>
                                <div class="modal-body">
                                    <div class="col-xs-3 5"></div>
                                    <div class="quiz" id="quiz" data-toggle="buttons">
                                        <?php foreach ($question['options'] as $index => $option): ?>
                                            <label class="element-animation<?php echo $index+1; ?> btn btn-lg btn-danger btn-block">
                                                <span class="btn-label">
                                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                                </span>
                                                <input type="radio" name="q_<?php echo $question_id; ?>_answer" value="<?php echo $option['option_id']; ?>">
                                                <?php echo htmlspecialchars($option['option_text']); ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Submit button inside the form -->
                <button type="submit" class="btn btn-primary">Submit Quiz</button>
            </form>
</body>
        
    </main>
    <footer>

    </footer>

  
    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>