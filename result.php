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
$quizQuestions = null;

if (
    isset($_POST['submit'])
) {
    $stmt = $connection->prepare("select * from users where email = ?");
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt = $connection->prepare("select * from lesson where id = ?");
    $stmt->bind_param("i", $_POST['lessonId']);
    $stmt->execute();
    $lesson = $stmt->get_result()->fetch_assoc();

    $stmt = $connection->prepare("select * from question where lessonId = ?");
    $stmt->bind_param("i", $lesson['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $quizQuestions = array();
    $i = 0;

    $quizQuestion = $result->fetch_assoc();
    while (!empty($quizQuestion)) {
        $quizQuestions[$i] = $quizQuestion;
        $i = $i + 1;
        $quizQuestion = $result->fetch_assoc();
    }

    $score = 0;
    if ($quizQuestions[0]['correctOption'] == $_POST['q1']) {
        $score += 1;
    }
    if ($quizQuestions[1]['correctOption'] == $_POST['q2']) {
        $score += 1;
    }
    if ($quizQuestions[2]['correctOption'] == $_POST['q3']) {
        $score += 1;
    }
    if ($quizQuestions[3]['correctOption'] == $_POST['q4']) {
        $score += 1;
    }

    $stmt = $connection->prepare("insert into quiz_score (usersId,lessonId,score) values (?,?,?)");
    $stmt->bind_param("sii", $user['id'], $lesson['id'], $score);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>

<head>

    <title><?php echo $lesson['quizTitle'] ?></title>
</head>

<body>
    <div class="common-container">
        <h1><?php echo $lesson['quizTitle']; ?></h1>
        <h2>You got <?php echo $score; ?> out of 4!</h2>
        <?php for ($i = 0; $i < 4; $i++) { ?>
            <fieldset>
                <legend><?php echo $quizQuestions[$i]['question']; ?></legend>
                <label>
                    <?php if (intval($quizQuestions[$i]['correctOption']) === 1) : ?>
                        <span style="color: green;"><?php echo $quizQuestions[$i]['option1']; ?></span>
                    <?php elseif (
                        intval($_POST['q' . ($i + 1)]) === 1 &&
                        intval($_POST['q' . ($i + 1)]) !== intval($quizQuestions[$i]['correctOption'])
                    ) : ?>
                        <span style="color: red;"><?php echo $quizQuestions[$i]['option1']; ?></span>
                    <?php else : ?>
                        <span style="color: blue;"><?php echo $quizQuestions[$i]['option1']; ?></span>
                    <?php endif; ?>
                </label><br />

                <label>
                    <?php if (intval($quizQuestions[$i]['correctOption']) === 2) : ?>
                        <span style="color: green;"><?php echo $quizQuestions[$i]['option2']; ?></span>
                    <?php elseif (
                        intval($_POST['q' . ($i + 1)]) === 2 &&
                        intval($_POST['q' . ($i + 1)]) !== intval($quizQuestions[$i]['correctOption'])
                    ) : ?>
                        <span style="color: red;"><?php echo $quizQuestions[$i]['option2']; ?></span>
                    <?php else : ?>
                        <span style="color: blue;"><?php echo $quizQuestions[$i]['option2']; ?></span>
                    <?php endif; ?>
                </label><br />

                <label>
                    <?php if (intval($quizQuestions[$i]['correctOption']) === 3) : ?>
                        <span style="color: green;"><?php echo $quizQuestions[$i]['option3']; ?></span>
                    <?php elseif (
                        intval($_POST['q' . ($i + 1)]) === 3 &&
                        intval($_POST['q' . ($i + 1)]) !== intval($quizQuestions[$i]['correctOption'])
                    ) : ?>
                        <span style="color: red;"><?php echo $quizQuestions[$i]['option3']; ?></span>
                    <?php else : ?>
                        <span style="color: blue;"><?php echo $quizQuestions[$i]['option3']; ?></span>
                    <?php endif; ?>
                </label><br />

                <label>
                    <?php if (intval($quizQuestions[$i]['correctOption']) === 4) : ?>
                        <span style="color: green;"><?php echo $quizQuestions[$i]['option4']; ?></span>
                    <?php elseif (
                        intval($_POST['q' . ($i + 1)]) === 4 &&
                        intval($_POST['q' . ($i + 1)]) !== intval($quizQuestions[$i]['correctOption'])
                    ) : ?>
                        <span style="color: red;"><?php echo $quizQuestions[$i]['option4']; ?></span>
                    <?php else : ?>
                        <span style="color: blue;"><?php echo $quizQuestions[$i]['option4']; ?></span>
                    <?php endif; ?>
                </label><br />
            </fieldset>
            </br>
        <?php } ?>
        <a href="home.php">
            <button class="btn">
                Go to home page!
            </button>
        </a>
    </div>
</body>

</html>
