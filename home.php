<?php
session_start();

?>

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

include ('dbconnection.php');


$stmt = $connection->prepare("select * from users where email = ?");
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt = $connection->prepare("select * from lesson;");
$stmt->execute();
$lessons = $stmt->get_result();


$stmt = $connection->prepare("select lessonId, max(score) as score 
                            from quiz_score where usersId = ? group by lessonId;");
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$result = $stmt->get_result();
$userScores = array();
$i = 0;
$userScore = $result->fetch_assoc();
while(!empty($userScore)){
    $userScores[$i] = $userScore;
    $i = $i + 1;
    $userScore = $result->fetch_assoc();
}

$finalScore = 0;

if (count($userScores) === 3) {
    $finalScore = $userScores[0]['score'] + $userScores[1]['score'] + $userScores[2]['score'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <div class="home">
        <center>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        </center>
        <div class="home-container">
            <h1>Hello <?php echo $user["name"] ?>!</h1>

            <?php if (count($userScores) === 3) { ?>
                <p>
                    Congratulations! You finished all quizzes. Your final score is
                    <?php echo $finalScore; ?>/12.
                </p>
            <?php } else { ?>
                <p>
                    Enjoy learning about English Grammar by taking our lessons and quizzes.
                </p>
            <?php } ?>
            <table class="lessons-table">
               
                <tr>
                    <th>#</th>
                    <th>Lesson Title</th>
                    <th>Quiz score</th>
                </tr>
               
                <?php
                for ($i = 0; $i < count($userScores) + 1; $i++) {
                    $lesson = $lessons->fetch_assoc();
                    if (isset($lesson)) { ?>
                        <tr>
                            <td><?php echo ($i + 1); ?></td>
                            <td><a href= "lesson.php?id=<?php echo $lesson['id']; ?>" style="text-decoration: none; color: black;">
                                    <?php echo $lesson['title']; ?>
                                </a></td>
                            <?php if (isset($userScores[$i]['score'])) { ?>
                                <td><?php echo $userScores[$i]['score']; ?></td>
                            <?php } else { ?>
                                <td>Not taken</td>
                            <?php } ?>
                        </tr>
                <?php }
                } ?>

            </table>
        </div>
</div>
</body>

</html>
