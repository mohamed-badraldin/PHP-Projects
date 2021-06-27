<?php
require_once('layout/head.php');
require_once('app/validations/User_validation.php');
require_once('app/models/User.php');
// check on the previous page //
$_previousPage = pathinfo($_SERVER['HTTP_REFERER'])['filename'];

// check on the url and the email is exist //
$emailCheck = new User_validation;
$user = $emailCheck->emailURLValidation($_GET);

if ($_POST) {
    // array to hold errors 
    $errors = [];
    // save the previous page in var //
    $previousPage = $_POST['previousPage'];

    // validate on code //
    $codeValidate = new User_validation;
    $codeValidate->setCode($_POST['code']);
    $codeErrors = $codeValidate->codeValidation();

    if (!$codeErrors) {
        // pass email and code to the User class //
        $codeCheck = new User;
        $codeCheck->setEmail($_GET['email']);
        $codeCheck->setCode($_POST['code']);

        // check if there is user has this code ans this email in DB //
        $rightCode = $codeCheck->codeCheckDB();

        if ($rightCode) {

            if ($previousPage === 'register' || $previousPage === 'login') {
                // updating the user status //
                $codeCheck->setStatus(1);
                $statusUpdated = $codeCheck->updateStatus();

                //when status is updated save user's info in the session and redirect to home //
                if ($statusUpdated) {
                    $_SESSION['user'] = $user;
                    header('location:index.php');
                } else {
                    $errors['someThing'] = "<div class='alert alert-danger'> SomeThing Went Wrong </div>";
                }
            }
            // redirect to make a new password //
            if ($previousPage === 'verify-email') {
                header('location:new-password.php?email=' . $_GET['email']);
            }

            if ($previousPage === 'profile') {
                // update new Email
                $codeCheck->setEmail($_SESSION['new-email']);
                $codeCheck->setId($_SESSION['user']->id);
                $updatedEmail = $codeCheck->updateEmail();
                if ($updatedEmail) {
                    // header logout;
                    $errors['success'] = "<div class='alert alert-success text-center'> Your Mail Updated Successfully , You Will Be Redirected To Login Again </div>";
                    header('refresh:4;url=logout.php');
                } else {
                    $errors['someThing'] = "<div class='alert alert-danger'> SomeThing Went Wrong </div>";
                }
            }
        } else {
            $errors['code'] = "<div class='alert alert-danger'> Wrong Code </div>";
        }
    } else {
        $errors = $codeErrors;
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
                            <h4> Check Code </h4>
                        </a>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="text" name="code" placeholder="Code">
                                        <?php
                                        if (isset($errors)) {
                                            foreach ($errors as $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <input type="hidden" name="previousPage" value="<?php echo $_previousPage ?>">
                                        <div class="button-box">
                                            <button type="submit"><span>Verify</span></button>
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