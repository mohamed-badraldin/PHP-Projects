<?php
require_once('layout/head.php');
require_once('app/validations/User_validation.php');
require_once('app/models/User.php');

// validate on the email in url //
$user_validation = new user_validation;
$user_validation->setEmail($_GET['email']);
$existUser = $user_validation->emailURLValidation($_GET);


if($_POST){
    $errors = [];

    // validate on the password and confirm password //
    $user_validation->setPassword($_POST['password']);
    $user_validation->setConfrim($_POST['cofrimPassword']);
    $password_errors = $user_validation->passwordValidation();

    // if the email and password are valid //
    if(!$password_errors) {
        // update new password //
        $user = new User;
        $user->setPassword($_POST['password']);
        $user->setEmail($_GET['email']);

        // prevent old password
        if($existUser->password == $user->getPassword()){
            $errors['old-password'] = "<div class='alert alert-danger'> Enter a new one </div>";
        }else{
            $passwordUpdated = $user->updatePassowrd();
            if($passwordUpdated){
                $existUser->password =  $user->getPassword();
                $_SESSION['user'] = $existUser;
                header('location:index.php');
            }else{
                $errors['someThing'] = "<div class='alert alert-danger'> SomeThing Went Wrong </div>";
            }
        }
    }else{
        $errors = $password_errors;
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
                            <h4> New Password </h4>
                        </a>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="password" name="password" placeholder="Password">
                                        <input type="password" name="cofrimPassword" placeholder="Confrim Password">
                                        <?php 
                                            if(isset($errors) && $errors){
                                                foreach ($errors as $value) {
                                                    echo $value;
                                                }
                                            }
                                        ?>
                                        <div class="button-box">
                                            <button type="submit"><span>Change</span></button>
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