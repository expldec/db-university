<?php
class Department {
    public $id;
    public $name;
    public $address;
    public $phone;
    public $email;
    public $website;
    public $head_of_department;

    function __construct($_id, $_name)
    {
        $this->id = $_id;
        $this->name = $_name;

    }

    function setDetails ($_address, $_phone, $_email, $_website, $_head_of_department)
    {
        $this->address = $_address;
        $this->phone = $_phone;
        $this->email = $_email;
        $this->website = $_website;
        $this->head_of_department = $_head_of_department;
    }
}