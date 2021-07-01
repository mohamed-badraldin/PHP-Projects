<?php
require_once("layout/head.php");
require_once("app/validations/User_validation.php");
require_once("app/models/User.php");
require_once('app/phpmailer/phpmailer.php');

if ($_POST) {
    $user_validation = new User_validation;
    $user_validation->setEmail($_POST['email']);
    $email_errors = $user_validation->emailValidation();
    if (!$email_errors) {
        $user = new User;
        $user->setEmail($_POST['email']);
        $existUser = $user->emailCheckDB();
        if ($existUser) {
            sendMail($existUser->name, $existUser->code, $existUser->email);
        } else {
            $errors['someThing'] = "<div class='alert alert-danger'> SomeThing Went Wrong </div>";
        }
    } else {
        $errors['email'] = "<div class='alert alert-danger'> This Email Not Exist </div>";
    }
}

?>

<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Verify Email </h4>
                        </a>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="email" name="email" placeholder="Email">
                                        <?php
                                        if (isset($email_errors) && $email_errors) {
                                            foreach ($email_errors as $value) {
                                                echo $value;
                                            }
                                        }
                                        if (isset($errors) && $errors) {
                                            foreach ($errors as $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <button name="submit" type="submit"><span>Verify</span></button>
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

<?php include_once "layout/footer.php"; ?>