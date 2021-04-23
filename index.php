<?php
session_start();

?>

<?php
include('dbconnection.php');
?>

<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login">
                <center>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        <div class="balloon"></div>
        </center>
        <div class="login-container">
            <div class="form-container">
                <h3>Login</h3>

                <form id="login" name="login" action="index.php" method="post">
                    <div id= "label"><label>Email</label></div>
                    <input class="text-input" name="email" placeholder="example@example.com" type="text"><span class="error" id="email"></span><br>
                    <div id= "label"><label>Password</label></div> 
                    <input class="text-input" type="password" name="password" placeholder="****"><span class="error" id="password"></span><br><br>
                    <button class="btn" type="submit" name="login">Sign In</button>
                </form>
                <?php
                $errMsg = '';
                if (isset($_POST['login'])) {
                    $stmt = $connection->prepare("select password from users where email = ?");
                    $stmt->bind_param("s", $_POST['email']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    if (
                        $_POST['password'] == $row['password']
                    ) {
                        $_SESSION['email'] = $_POST['email'];
                ?>
                        <script>
                            document.location.replace("home.php");
                        </script>
                    <?php
                        exit();
                    } else {
                    ?>
                        <span class="error">
                            Wrong username or password
                        </span>
                <?php
                    }
                }
                ?>
            </div>
            <p>You don't have an account? <a href="register.php">register here</a></p>
        </div>
    </div>

    <script>
        var form = document.getElementById('login');

        form.addEventListener('submit', function(event) {
            var emailErr = document.getElementById('email');
            var passwordErr = document.getElementById('password');

            if (document.forms.login.email.value === "") {
                emailErr.innerText = 'You must enter an email';
                event.preventDefault();
            } else if (!new RegExp('(.+)@(.+){2,}\.(.+){2,}').test(document.forms.login.email.value)) {
                emailErr.innerText = 'Email should be of an appropriate format';
                event.preventDefault();
            } else {
                emailErr.innerText = '';
            }

            if (document.forms.login.password.value === "") {
                passwordErr.innerText = 'You must enter a password';
                event.preventDefault();
            } else {
                passwordErr.innerText = '';
            }
        });
    </script>
</body>

</html>
