
<?php
require_once __DIR__ . "/../database/operations.php";
require_once __DIR__ . "/../database/Database.php";
class User extends Database implements operaitons
{
    private $id;
    private $name;
    private $phone;
    private $email;
    private $password;
    private $code;
    private $gender;
    private $status;
    private $image;
    private $order_id;
    private $created_at;
    private $uodated_at;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

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
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = sha1($password);

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

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of order_id
     */
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     *
     * @return self
     */
    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of uodated_at
     */
    public function getUodated_at()
    {
        return $this->uodated_at;
    }

    /**
     * Set the value of uodated_at
     *
     * @return self
     */
    public function setUodated_at($uodated_at)
    {
        $this->uodated_at = $uodated_at;

        return $this;
    }

    // prepare SQL query to pass to Database class //

    function insertData()
    {
        $query = "  INSERT INTO 
                        `users` (`users`.`name`,`users`.`phone`,`users`.`email`,`users`.`password`,`users`.`gender`,`users`.`code`) 
                    VALUES ('$this->name','$this->phone','$this->email','$this->password','$this->gender',$this->code)";

        return $this->runDML($query);
    }
    public function updateData()
    {
        $query = "UPDATE `users` SET 
                    `users`.`name` = '$this->name',
                    `users`.`phone` = '$this->phone',
                    `users`.`gender` = '$this->gender'
                 ";

        if ($this->image) {
            $query .= " ,`users`.`image` = '$this->image' ";
        }

        $query .= " WHERE `users`.`id` = $this->id ";
        return $this->runDML($query);
    }

    function deleteData()
    {
    }
    function selectAllData()
    {
    }
    public function emailCheckDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' ";
        return $this->runDQL($query);
    }

    public function codeCheckDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`code` = $this->code AND `users`.`email` = '$this->email' ";
        return $this->runDQL($query);
    }

    public function updateStatus()
    {
        $query = "UPDATE `users` SET `users`.`status` = $this->status WHERE `users`.`email` = '$this->email' ";
        return $this->runDML($query);
    }

    public function login()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`password` = '$this->password'";
        return $this->runDQL($query);
    }

    public function updatePassowrd()
    {
        $query = "UPDATE `users` SET `users`.`password` = '$this->password' WHERE `users`.`email` = '$this->email' ";
        return $this->runDML($query);
    }

    public function updateCode()
    {
        $query = "UPDATE `users` SET `users`.`code` = $this->code WHERE `users`.`email` = '$this->email'";
        return $this->runDML($query);
    }

    public function updateEmail()
    {
        $query = "UPDATE `users` SET `users`.`email` = '$this->email' WHERE `users`.`id` = '$this->id'";
        return $this->runDML($query);
    }
}

?>