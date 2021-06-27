<?php
require_once __DIR__ . "/../database/Database.php";
require_once __DIR__ . "/../database/operations.php";

class Region extends Database implements operaitons
{

    private $id;
    private $name;
    private $status;
    private $lat;
    private $log;
    private $rad;
    private $city_id;
    private $created_at;
    private $updated_at;


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
     * Get the value of lat
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @return self
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of log
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Set the value of log
     *
     * @return self
     */
    public function setLog($log)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Get the value of rad
     */
    public function getRad()
    {
        return $this->rad;
    }

    /**
     * Set the value of rad
     *
     * @return self
     */
    public function setRad($rad)
    {
        $this->rad = $rad;

        return $this;
    }

    /**
     * Get the value of city_id
     */
    public function getCity_id()
    {
        return $this->city_id;
    }

    /**
     * Set the value of city_id
     *
     * @return self
     */
    public function setCity_id($city_id)
    {
        $this->city_id = $city_id;

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
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    // prepare SQL query to pass to Database class //

    function insertData()
    {
    }
    function updateData()
    {
    }
    function deleteData()
    {
    }

    public function selectAllData()
    {
        $query = "SELECT `regions`.* FROM `regions` ORDER BY `regions`.`name` ASC";
        return $this->runDQL($query);
    }

    public function selectCityRegions($id)
    {
        $query = "SELECT `regions`.* FROM `regions` WHERE `regions`.`city_id` = $id ORDER BY `regions`.`name` ASC";
        return $this->runDQL($query);
    }
}
