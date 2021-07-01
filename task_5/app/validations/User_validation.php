<?php
require_once __DIR__ . "/../models/User.php";

class User_validation
{
    private $password;
    private $confrim;
    private $email;
    private $code;

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of confrim
     */
    public function getConfrim()
    {
        return $this->confrim;
    }

    /**
     * Set the value of confrim
     *
     * @return  self
     */
    public function setConfrim($confrim)
    {
        $this->confrim = $confrim;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function passwordValidation()
    {
        // Array holds errors 
        $errors = [];
        // regular expretion pattern to validate the password
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        // if the passward is not exist send error
        if (!$this->password) {
            $errors['password'] = "<div class='alert alert-danger text-center'> Password Is Required </div>";
        }
        // if the confirm password not exist send error
        if (!$this->confrim) {
            $errors['confirm'] = "<div class='alert alert-danger text-center'> Confirm Password Is Required </div>";
        }
        if (empty($errors)) {
            // compare the password with the pattern
            if (!preg_match($pattern, $this->password)) {
                $errors['pattern'] = "<div class='alert alert-danger text-center'> Password Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character </div>";
            }
            // check the password and confirm password are identicals
            if ($this->password != $this->confrim) {
                $errors['confrim'] = "<div class='alert alert-danger text-center'> Password dose n't Matched </div>";
            }
        }
        // return errors array if exists
        return $errors;
    }

    public function passwordLoginValidation()
    {
        // Array holds errors 
        $errors = [];
        // regular expretion pattern to validate the password
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        // if the passward is not exist send error
        if (!$this->password) {
            $errors['password'] = "<div class='alert alert-danger text-center'> Password Is Required </div>";
        }
        if (empty($errors)) {
            // compare the password with the pattern
            if (!preg_match($pattern, $this->password)) {
                $errors['pattern'] = "<div class='alert alert-danger text-center'> Wrong email or password </div>";
            }
        }
        // return errors array if exists
        return $errors;
    }

    public function emailValidation()
    {
        // Array holds errors 
        $errors = [];

        // regular expretion pattern to validate the email
        $pattern = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";

        // if the email is not exist send error
        if (!$this->email) {
            $errors['email'] = "<div class='alert alert-danger text-center'> Email Is Required </div>";
        } else {
            // compare the email with the pattern
            if (!preg_match($pattern, $this->email)) {
                $errors['pattern'] = "<div class='alert alert-danger text-center'> Wrong Email Format </div>";
            }
        }

        // return errors array if exists
        return $errors;
    }

    public function emailURLValidation($url)
    {
        // check if the url is exist and has email key with value //
        if ($url && isset($url['email']) && $url['email']) {

            // use emailCheckBD method in User class to check if the email exist in BD //
            $emailChecked = new User;
            $emailChecked->setEmail($url['email']);
            $userData = $emailChecked->emailCheckDB();

            if ($userData) return $userData;
            else header('location:404.php');
        } else header('location:404.php');
    }

    public function codeValidation()
    {
        $errors = [];
        // if not exist
        if (!$this->code) {
            $errors['require'] = "<div class='alert alert-danger text-center'> Code is required </div>";
            return $errors;
        }
        // compare the code with the pattern
        if (!preg_match('/^([0-9]{5})$/', $this->code)) {
            $errors['pattern'] = "<div class='alert alert-danger text-center'> Invalid Code </div>";
            return $errors;
        }
    }
}
