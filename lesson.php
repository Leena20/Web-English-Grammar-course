<?php
session_start();
?>
<link rel="stylesheet" href="style.css">
<?php
if (!isset($_SESSION['email'])) {
?>
    <div class="common-container">
        <h1>Unauthorized Access!</h1>
        <p>
            You are not authorized to access this page.
            Please <a href="index.php">click here</a> to login first.
        </p>
    </div>
<?php
    exit();
}

include('dbconnection.php');

$lesson = null;
$id = htmlspecialchars($_GET['id']);

if (isset($_GET['id'])) {
    $stmt = $connection->prepare("select * from lesson where id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $lesson = $stmt->get_result()->fetch_assoc();
}

$stmt = $connection->prepare("select * from users where email = ?");
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt = $connection->prepare("select lessonId, max(score) as score 
                        from quiz_score where usersId = ? group by lessonId;");
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$quizScores = $stmt->get_result();

if (!isset($lesson['ranking'])) { ?>
    <div class="common-container">
        <h1>This lesson does not exist!</h1>
    </div>
<?php
    exit();
} else if ($lesson['ranking'] > ($quizScores->num_rows + 1)) {
?>
    <div class="common-container">
        <h1>To take this lesson you got to finish the previous lesson!</h1>
    </div>
<?php
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    
    <title><?php echo $lesson['title'] ?></title>
</head>

<body>
    <div class="common-container">
        <h1><?php echo $lesson['title'] ?></h1>
        <div class="dynamic-content"><?php echo htmlspecialchars_decode(stripslashes($lesson['content'])); ?></div>
        <a href="quiz.php?id=<?php echo $lesson['id'] ?>" style="text-decoration: none"><button class="btn btn-sticky-bottom">
                Go to quiz
            </button>
        </a>
    </div>
</body>

</html>
