<?php
session_start();

?>
<link rel="stylesheet" href="style.css">
<?php
include('dbconnection.php');
?>

<html>

<head>
    <title>Register Page</title>
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
        <div class="register-container">
            <div class="form-container">
                <h3>Please enter your information below to register as a new user</h3>
                <form id="register" name="register" action="register.php" method="post">
                   <div id= "label"><label>Name</label></div>
                    <input class="text-input" name="name" placeholder="Name" type="text"><span class="error" id="name"></span><br><br>

                   <div id= "label"><label for="email">Email</label></div>
                    <input class="text-input" name="email" placeholder="Email" type="text"><span class="error" id="email"></span><br><br>

                    <div id= "label"><label for="password">Password</label></div>
                    <input class="text-input" type="password" name="password" placeholder="Password"><span class="error" id="password"></span><br><br>

                   <div id= "label"><label for="confirmPassword">Confirm Password</label></div>
                    <input class="text-input" type="password" name="confirmPassword" placeholder="Password"><span class="error" id="confirmPassword"></span><br><br>
                    <button class="btn" type="submit" name="register">Register</button>
                </form>
                <?php
                if (isset($_POST['register'])) {
                    $stmt = $connection->prepare("select * from users where email = ?");
                    $stmt->bind_param("s", $_POST['email']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 0) {
                        $stmt = $connection->prepare("insert into users (name,email,password) values (?,?,?)");
                        $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['password']);
                        $stmt->execute();

                ?>
                        <script>
                            document.location.replace("index.php");
                        </script>
                    <?php
                        exit();
                    } else {
                    ?>
                        <span class="error">
                            email has been registered before!
                        </span>
                        <span class="error">
                            please use another email, or login with it.
                        </span>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
<script>
    var form = document.getElementById('register');

    form.addEventListener('submit', function(event) {
        var nameErr = document.getElementById('name');
        var emailErr = document.getElementById('email');
        var passwordErr = document.getElementById('password');
        var confirmPasswordErr = document.getElementById('confirmPassword');

        if (document.forms.register.name.value === "") {
            nameErr.innerText = 'You must enter your name';
            event.preventDefault();
        } else {
            nameErr.innerText = '';
        }

        if (document.forms.register.email.value === "") {
            emailErr.innerText = 'You must enter your email';
            event.preventDefault();
        }
        else if (!new RegExp('(.+)@(.+){2,}\.(.+){2,}').test(document.forms.register.email.value)) {
            emailErr.innerText = 'Email should be of an appropriate format';
            event.preventDefault();
        } else {
            emailErr.innerText = '';
        }

        if (document.forms.register.password.value === "") {
            passwordErr.innerText = 'You must enter your password';
            event.preventDefault();
        } else {
            passwordErr.innerText = '';
        }

        if (document.forms.register.confirmPassword.value === "") {
            confirmPasswordErr.innerText = 'You must enter a confirm password';
            event.preventDefault();
        }
        else if (document.forms.register.password.value !== document.forms.register.confirmPassword.value) {
            confirmPasswordErr.innerText = 'Passwords must match';
            event.preventDefault();
        } else {
            confirmPasswordErr.innerText = '';
        }
    });
</script>

</html>
