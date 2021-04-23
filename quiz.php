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

$id = htmlspecialchars($_GET['id']);

$stmt = $connection->prepare("select * from lesson where id = ?");
$stmt->bind_param("i", $id);
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

if (empty($lesson['ranking'])) { ?>
    <div class="common-container">
        <h1>This quiz does not exist!</h1>
    </div>
<?php
    exit();
} else if ($lesson['ranking'] > ($quizScores->num_rows + 1)) {
?>
    <div class="common-container">
        <h1>To take this quiz you got to finish the previous lesson!</h1>
    </div>
<?php
    exit();
}
?>
<!DOCTYPE html>
<html id = "quizzes">

<head>

    <title><?php echo $lesson['quizTitle'] ?></title>
</head>

<body id = "quizzes">
    <div class="common-container">
        <h1><?php echo $lesson['quizTitle']; ?></h1>
        <form id="quiz" name="quiz" role="form" action="result.php" method="post">
            <input hidden type="text" value="<?php echo $lesson['id'] ?>" name="lessonId">
            <fieldset id="q1">
                <legend><?php echo $quizQuestions[0]['question']; ?></legend>

                <input type="radio" value="1" name="q1">
                <label for="q1"><?php echo $quizQuestions[0]['option1']; ?></label><br />

                <input type="radio" value="2" name="q1">
                <label for="q1"><?php echo $quizQuestions[0]['option2']; ?></label><br />

                <input type="radio" value="3" name="q1">
                <label for="q1"><?php echo $quizQuestions[0]['option3']; ?></label><br />

                <input type="radio" value="4" name="q1">
                <label for="q1"><?php echo $quizQuestions[0]['option4']; ?></label><br />
            </fieldset>
            <span class="error" id="q1err"></span>
            </br>

            <fieldset id="q2">
                <legend><?php echo $quizQuestions[1]['question']; ?></legend>

                <input type="radio" value="1" name="q2">
                <label for="q2"><?php echo $quizQuestions[1]['option1']; ?></label><br />

                <input type="radio" value="2" name="q2">
                <label for="q2"><?php echo $quizQuestions[1]['option2']; ?></label><br />

                <input type="radio" value="3" name="q2">
                <label for="q2"><?php echo $quizQuestions[1]['option3']; ?></label><br />

                <input type="radio" value="4" name="q2">
                <label for="q2"><?php echo $quizQuestions[1]['option4']; ?></label><br />
            </fieldset>
            <span class="error" id="q2err"></span>
            </br>

            <fieldset id="q3">
                <legend><?php echo $quizQuestions[2]['question']; ?></legend>

                <input type="radio" value="1" name="q3">
                <label for="q3"><?php echo $quizQuestions[2]['option1']; ?></label><br />

                <input type="radio" value="2" name="q3">
                <label for="q3"><?php echo $quizQuestions[2]['option2']; ?></label><br />

                <input type="radio" value="3" name="q3">
                <label for="q3"><?php echo $quizQuestions[2]['option3']; ?></label><br />

                <input type="radio" value="4" name="q3">
                <label for="q3"><?php echo $quizQuestions[2]['option4']; ?></label><br />
            </fieldset>
            <span class="error" id="q3err"></span>
            </br>

            <fieldset id="q4">
                <legend><?php echo $quizQuestions[3]['question']; ?></legend>

                <input type="radio" value="1" name="q4">
                <label for="q4"><?php echo $quizQuestions[3]['option1']; ?></label><br />

                <input type="radio" value="2" name="q4">
                <label for="q4"><?php echo $quizQuestions[3]['option2']; ?></label><br />

                <input type="radio" value="3" name="q4">
                <label for="q4"><?php echo $quizQuestions[3]['option3']; ?></label><br />

                <input type="radio" value="4" name="q4">
                <label for="q4"><?php echo $quizQuestions[3]['option4']; ?></label><br />
            </fieldset>
            <span class="error" id="q4err"></span>
            </br>
            <button class="btn" type="submit" name="submit">Submit</button></br>
            <button class="btn" type="reset" name ="reset">Reset</button>
        </form>
    </div>
    <script>
        var form = document.getElementById('quiz');

        form.addEventListener('submit', function(event) {
            var q1err = document.getElementById('q1err');
            var q2err = document.getElementById('q2err');
            var q3err = document.getElementById('q3err');
            var q4err = document.getElementById('q4err');
            if (document.forms.quiz.q1.value == "") {
                q1err.innerHTML = 'One choice should be selected';
                event.preventDefault();
            } else {
                q1err.innerHTML = '';
            }
            if (document.forms.quiz.q2.value == "") {
                q2err.innerHTML = 'One choice should be selected';
                event.preventDefault();
            } else {
                q2err.innerHTML = '';
            }
            if (document.forms.quiz.q3.value == "") {
                q3err.innerHTML = 'One choice should be selected';
                event.preventDefault();
            } else {
                q3err.innerHTML = '';
            }
            if (document.forms.quiz.q4.value == "") {
                q4err.innerHTML = 'One choice should be selected';
                event.preventDefault();
            } else {
                q4err.innerHTML = '';
            }
        });

        form.addEventListener('reset', function(event) {
            document.getElementById('q1err').innerHTML = "";
            document.getElementById('q2err').innerHTML = "";
            document.getElementById('q3err').innerHTML = "";
            document.getElementById('q4err').innerHTML = "";
        });
    </script>
</body>

</html>
