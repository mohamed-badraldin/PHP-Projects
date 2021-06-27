<?php
require_once('layout/head.php');
require_once('app/auth/authentication.php');
require_once('layout/header.php');
require_once('app/models/User.php');
require_once('app/validations/User_validation.php');
require_once('app/phpmailer/phpmailer.php');
require_once('app/models/Address.php');
require_once('app/models/Region.php');
require_once('app/models/City.php');

///////////////////////////////////////////////////////////////////////////// update user info start //
if (isset($_POST['update-info'])) {
    $info = [];
    if (
        isset($_POST['name']) && $_POST['name'] &&
        isset($_POST['phone']) && $_POST['phone'] &&
        isset($_POST['gender']) && $_POST['gender']
    ) {
        // update user info //
        $update = new User;
        $update->setName($_POST['name']);
        $update->setEmail($_POST['phone']);
        $update->setGender($_POST['gender']);
        $update->setId($_SESSION['user']->id);

        if ($_FILES['image']['error'] == 0) {
            // validate on photo size
            if ($_FILES['image']['size'] > (10 ** 6)) {
                $errorsinfo['img-size'] = "<div class='alert alert-danger text-center'> Image Must Be Less Than 1 MegaByte </div>";
            }
            // validate on photo extension
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $allowedExtenions = ['png', 'jpg', 'jpeg'];
            if (!in_array($extension, $allowedExtenions)) {
                $errorsinfo['img-extension'] = "<div class='alert alert-danger text-center'> Image Must Be jpg,png,jpeg </div>";
            }
            if (!$errorsinfo) {
                $directory = "assets/img/users/";
                $photoName =  time() . '-user-' . $_SESSION['user']->id . '.' . $extension;
                $fullPath = $directory . $photoName;
                // code to upload photo
                move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
                $update->setImage($photoName);
                $_SESSION['user']->image = $photoName;
            }
        }
        // updatig the user data //
        $updated = $update->updateData();
        if ($updated) {
            // save data in the session //
            foreach ($_POST as $key => $value) {
                $_SESSION['user']->$key = $value;
            }
            if (!$errorsinfo) $successInfo = "<div class='alert alert-success text-center'> Your Data Has Been Updated Successfully </div>";
        } else {
            $errorsinfo['someThing'] = "<div class='alert alert-danger text-center'> Something went wrong </div>";
        }
    } else $errorsinfo['required'] = "<div class='alert alert-danger text-center'> All Fields Are Required there are </div>";
}
///////////////////////////////////////////////////////////////////////////// update user info end //

///////////////////////////////////////////////////////////////////////////// update user password start //
if (isset($_POST['update-password'])) {
    $errorsPass = [];
    if (
        isset($_POST['old-password']) && $_POST['old-password'] &&
        isset($_POST['new-password']) && $_POST['new-password'] &&
        isset($_POST['confirm-password']) && $_POST['confirm-password']
    ) {
        // check if old password is correct
        if ($_SESSION['user']->password == sha1($_POST['old-password'])) {
            // check if old password == new password
            if ($_POST['old-password']  == $_POST['new-password'])
                $errorsPass['enter-new-password'] = "<div class='alert alert-danger text-center'> You Have Entered Your Old Password </div>";
            // check if new password = confirm password and have Specific Pattern
            if (!$errorsPass) {
                $user_validation = new User_validation;
                $user_validation->setPassword($_POST['new-password']);
                $user_validation->setConfrim($_POST['confirm-password']);
                $errorsPass = $user_validation->passwordValidation();

                if (!$errorsPass) {
                    $user = new User;
                    $user->setEmail($_SESSION['user']->email);
                    $user->setPassword($_POST['new-password']);
                    $passUpdated = $user->updatePassowrd();
                    if ($passUpdated) {
                        $_SESSION['user']->password = $user->getPassword();
                        $successPass = "<div class='alert alert-success text-center'> Your Password Has Been Updated Successfully </div>";
                    } else $errorsPass['updatePass'] = "<div class='alert alert-danger text-center'> SoneThing Went Wrong </div>";
                }
            }
        } else $errorsPass['wrongPass'] = "<div class='alert alert-danger text-center'> Wrong Password </div>";
    } else  $errorsPass['all-fields'] = "<div class='alert alert-danger text-center'> All Fields Required </div>";
}

///////////////////////////////////////////////////////////////////////////// update user password start //

///////////////////////////////////////////////////////////////////////////// update user email start //
if (isset($_POST['update-email'])) {
    $errorsEmail = [];
    // validate the code pattern // 
    $user_validation = new User_validation;
    $user_validation->setEmail($_POST['email']);
    $errors_email_validate = $user_validation->emailValidation();

    if (!$errors_email_validate) {
        // check if the email is the current email // 
        if ($_SESSION['user']->email == $_POST['email']) {
            $errorsEmail['old-email'] = "<div class='alert alert-danger text-center'> You Have Entered An Old Email </div>";
        }
        if (!$errorsEmail) {
            // check if the email exist on DB // 
            $user = new User;
            $user->setEmail($_POST['email']);
            $email_exist = $user->emailCheckDB();
            if ($email_exist) {
                // email already exists
                $errorsEmail['exist-email'] = "<div class='alert alert-danger text-center'> Email Already Exists </div>";
            } else {
                // update code in db
                $code = rand(10000, 99999);
                $user->setEmail($_SESSION['user']->email);
                $user->setCode($code);
                $updatedCode = $user->updateCode();
                if ($updatedCode) {
                    $_SESSION['new-email'] = $_POST['email'];
                    sendMail($_SESSION['user']->name, $code, $_SESSION['user']->email);
                } else  $errorsEmail['SomeThing'] = "<div class='alert alert-danger text-center'> SomeThing Went Wrong </div>";
            }
        }
    } else $errorsEmail = $errors_email_validate;
}
///////////////////////////////////////////////////////////////////////////// update user email end //

///////////////////////////////////////////////////////////////////////////// update user addresses start //
// get addresses of the user
$addressObj = new Address;
$addressObj->setId($_SESSION['user']->id);
$addresses = $addressObj->userAddresses();
// get all regions from DB //
$region = new Region;
$regions = $region->selectAllData();
// get all cities //
$cityObj = new City;
$cities = $cityObj->selectAllData();


///////////////////////////////////////////////////////////////////////////// update user addresses end //

?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>MY ACCOUNT</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse
                             <?php if ((isset($errorsinfo) && $errorsinfo) || $successInfo) echo 'show'; ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                            <h5>Your Personal Details</h5>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="col-4 offset-4 form-group">
                                                <img src="assets/img/users/<?php echo $_SESSION['user']->image ?>" alt="" class="w-100 h-50 rounded-circle">
                                                <input type="file" name="image" class="form-control-file">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Name</label>
                                                        <input name="name" type="text" value="<?php echo $_SESSION['user']->name; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input name="phone" type="text" value="<?php echo $_SESSION['user']->phone; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select name='gender' id="" class="form-control">
                                                            <option value="m" <?php if ($_SESSION['user']->gender  == 'm') echo 'selected' ?>>Male</option>
                                                            <option value="f" <?php if ($_SESSION['user']->gender  == 'f') echo 'selected' ?>>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- show errors -->
                                            <?php if (isset($errorsinfo) && $errorsinfo) foreach ($errorsinfo as $value) echo $value;
                                            if (isset($successInfo)) echo $successInfo
                                            ?>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-info" value="done">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse <?php if ((isset($errorsPass) && $errorsPass) || $successPass) echo 'show' ?>">
                                <div class="panel-body">
                                    <form action="" method="post">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                                <h5>Your Password</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password</label>
                                                        <input type="password" name="old-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password Confirm</label>
                                                        <input type="password" name="confirm-password">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (isset($errorsPass) && $errorsPass) foreach ($errorsPass as $value) echo $value;
                                            if (isset($successPass)) echo $successPass;
                                            ?>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-password">Update Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-4">Change your Email </a></h5>
                            </div>
                            <div id="my-account-4" class="panel-collapse collapse <?php if ((isset($errorsEmail) && $errorsEmail)) echo 'show' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Email</h4>
                                        </div>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Email Address</label>
                                                        <input type="email" name="email" value="<?php echo $_SESSION['user']->email ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (isset($errorsEmail) && $errorsEmail) foreach ($errorsEmail as $value) echo $value ?>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-email">Update Email</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your addresses </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Addresses</h4>
                                        </div>
                                        <?php foreach ($addresses as $address) { ?>
                                            <form class="mt-5">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="street">Street</label>
                                                        <input type="text" id="street" class="form-control" name="street" value="<?php echo $address['street'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="building">Building</label>
                                                        <input type="text" id="building" class="form-control" name="building" value="<?php echo $address['building'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="floor">floor</label>
                                                        <input type="text" id="floor" class="form-control" name="floor" value="<?php echo $address['floor'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="flat">flat</label>
                                                        <input type="text" id="flat" class="form-control" name="flat" value="<?php echo $address['flat'] ?>">
                                                    </div>
                                                </div>


                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="region">Region</label>
                                                        <select name="region" class="form-control id=" region">
                                                        <?php foreach($cities as $city) {?>
                                                            <optgroup label="<?php echo $city['name']?>">
                                                                <?php 
                                                                $city_regions = $region->selectCityRegions($city['id']);
                                                                foreach($city_regions as $reg){
                                                                ?>
                                                                <option <?php echo ($reg['id'] == $address['region_id']) ? 'selected' : ''?>value="<?php echo $reg['id']?>"><?php echo $reg['name']?></option>
                                                                <?php }?>
                                                            </optgroup>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="notes">Notes</label>
                                                    <textarea class="form-control" id="notes" rows="3"></textarea>
                                                </div>


                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- my account end -->
<?php require_once("layout/footer.php"); ?>
<div class="form-group col-md-6">
    <label for="inputCity">City</label>
    <input type="textarea" class="form-control" id="inputCity">
</div>