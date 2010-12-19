<?php
class Employee
{
    private $id;
    private $name = '';
    private $updated;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = (int)$id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = (string)$name;
    }
    
    public function getUpdated() {
        return $this->updated;
    }
    
    public function setUpdated(DateTime $updated) {
        $this->updated = $updated;
    }
}