<?php
require_once('layout/head.php');
require_once('app/auth/authentication.php');
require_once('layout/header.php');
require_once('app/validations/User_validation.php');
require_once('app/models/User.php');
require_once('app/phpmailer/phpmailer.php');


// when user submit the form
if (isset($_POST['submit'])) {

    // array holds errors if exsits
    $errors = [];

    // passing password and email to validate and retrun errors if exists //
    $user_validation = new User_validation;
    $user_validation->setPassword($_POST['password']);
    $user_validation->setConfrim($_POST['confrimPassword']);
    $password_erros = $user_validation->passwordValidation();

    $user_validation->setEmail($_POST['email']);
    $email_errors = $user_validation->emailValidation();

    // pass user values to User class //
    if (!$password_erros && !$email_errors) {
        $user = new User;
        $user->setName($_POST['name']);
        $user->setPassword($_POST['password']);
        $user->setEmail($_POST['email']);
        $user->setPhone($_POST['phone']);
        $user->setGender($_POST['gender']);
        $code = rand(10000, 99999);
        $user->setCode($code);

        // check if the email exist in the database //
        $emailExists = $user->emailCheckDB();

        // if the email is a new one //
        if (!$emailExists) {

            // insert DATA into the database return true or false //
            $inserted = $user->insertData();

            if ($inserted) {
                // send mail to user and move to check-code page to verify the code //
                sendMail($_POST['name'], $code, $_POST['email']);
            } else {
                $errors['something'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
            }
        } else {
            $errors['email'] = "<div class='alert alert-danger'> Email Already Exists </div>";
        }
    }
}
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Register</h3>

            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Register</li>
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
                            <h4> Register </h4>

                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="text-center">
                            <?php if (isset($errors['something'])) {
                                echo $errors['something'];
                            } ?>
                        </div>
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="text" name="name" placeholder="Username" value="<?php if (isset($_POST['name'])) {
                                                                                                            echo $_POST['name'];
                                                                                                        } ?>">
                                        <input name="email" placeholder="Email" type="email" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
                                        <?php
                                        // if the email not exist or not match the pattern show error //
                                        if (isset($email_errors) && $email_errors) {
                                            foreach ($email_errors as $value) {
                                                echo $value;
                                            }
                                        }
                                        // if the email is already exist in the database //
                                        if (isset($errors['email'])) {
                                            echo $errors['email'];
                                        }
                                        ?>
                                        <input name="phone" placeholder="Phone" type="phone" value="<?php if (isset($_POST['phone'])) {
                                                                                                        echo $_POST['phone'];
                                                                                                    } ?>">

                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (isset($password_erros) && isset($password_erros['password'])) {
                                            echo $password_erros['password'];
                                        }
                                        ?>
                                        <input type="password" name="confrimPassword" placeholder="Confirm Password">
                                        <?php
                                        if (isset($password_erros) && $password_erros) {
                                            foreach ($password_erros as $value) {
                                                if (isset($password_erros['password'])) {
                                                    continue;
                                                }
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <select name="gender" class="form-control mb-4" id="">
                                            <option <?php if (isset($_POST['gender']) && $_POST['gender'] == 'm') {
                                                        echo "selected";
                                                    } ?> value="m">Male</option>
                                            <option <?php if (isset($_POST['gender']) && $_POST['gender'] == 'f') {
                                                        echo "selected";
                                                    } ?> value="f">Female</option>
                                        </select>
                                        <div class="button-box">
                                            <button type="submit" name="submit"><span>Register</span></button>
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
<?php require_once("layout/footer.php"); ?>