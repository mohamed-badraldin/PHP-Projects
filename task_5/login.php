<?php
require_once('layout/head.php');
require_once('app/auth/authentication.php');
require_once('layout/header.php');
require_once('app/validations/User_validation.php');
require_once('app/models/User.php');
require_once('app/phpmailer/phpmailer.php');


if (isset($_POST['submit'])) {
    $user_validation = new User_validation;
    // validate the email //
    $user_validation->setEmail($_POST['email']);
    $email_errors = $user_validation->emailValidation();
    // validate the password //
    $user_validation->setPassword($_POST['password']);
    $password_errors = $user_validation->passwordLoginValidation();
    // if the email and password are valid //
    if (!$email_errors && !$password_errors) {
        $user = new User;
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        // check if the user is exist //
        $existUser = $user->login();
        if ($existUser) {
            if ($existUser->status == 1) {
                $_SESSION['user'] = $existUser;
                header('location:index.php');
            } elseif ($existUser->status == 0) {
                sendMail($existUser->name, $existUser->code, $existUser->email);
            }
        } else {
            $errors['auth'] = "<div class='alert alert-danger'> Wrong Email Or Password </div>";
        }
    }
}
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>LOGIN</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> login </h4>
                        </a>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="#" method="post">
                                        <input type="email" name="email" placeholder="Email" value="
                                        <?php if (isset($_POST['email'])) echo $_POST['email'] ?>">
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (isset($email_errors) && $email_errors) {
                                            foreach ($email_errors as $value) echo $value;
                                        }
                                        if (isset($password_errors) && $password_errors) {
                                            foreach ($password_errors as $value) echo $value;
                                        }
                                        if (isset($errors['auth'])) echo $errors['auth'];
                                        ?>

                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <a href="verify-email.php">Forgot Password?</a>
                                            </div>
                                            <button name="submit" type="submit"><span>Login</span></button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once('layout/footer.php');
?>