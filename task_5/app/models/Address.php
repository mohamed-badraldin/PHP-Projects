<?php 
require_once __DIR__ . "/../database/operations.php";
require_once __DIR__ . "/../database/Database.php";

class Address extends Database implements operaitons {
    
    private $id;
    private $street;
    private $building;
    private $floor;
    private $flat;
    private $notes;
    private $user_id;
    private $region_id;
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
     * Get the value of street
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @return self
     */ 
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of building
     */ 
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set the value of building
     *
     * @return self
     */ 
    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get the value of floor
     */ 
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set the value of floor
     *
     * @return self
     */ 
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get the value of flat
     */ 
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Set the value of flat
     *
     * @return self
     */ 
    public function setFlat($flat)
    {
        $this->flat = $flat;

        return $this;
    }

    /**
     * Get the value of notes
     */ 
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set the value of notes
     *
     * @return self
     */ 
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of region_id
     */ 
    public function getRegion_id()
    {
        return $this->region_id;
    }

    /**
     * Set the value of region_id
     *
     * @return self
     */ 
    public function setRegion_id($region_id)
    {
        $this->region_id = $region_id;

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

    function insertData() {

    }
    function updateData() {

    }
    function deleteData() {

    }
    function selectAllData() {

    }

    public function userAddresses()
    {
       $query = "SELECT `addresses`.* FROM `addresses` WHERE `addresses`.`user_id` = $this->id";
       return $this->runDQL($query);
    }
}
