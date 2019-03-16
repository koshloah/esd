<?php

class Dog {
    // property declaration
    // 12 columns
    public $name;
    public $age;
    public $breed;
    public $size;    
    public $sex;
    public $status;
    public $altered;
    public $hasShots;
    public $houseTrained;
    public $description;
    public $pic1;
    public $pic2;
    
    public function __construct($name='', $age='', $breed='', $size='',$sex='', $status='', $altered='', $hasShots='', $houseTrained='', $description='',$pic1='', $pic2='') {
        $this->name = $name;
        $this->age = $age;
        $this->breed = $breed;
        $this->size = $size;
        $this->sex = $sex;
        $this->status = $status;
        $this->altered = $altered;
        $this->hasShots = $hasShots;
        $this->houseTrained = $houseTrained;
        $this->description = $description;
        $this->pic1 = $pic1;
        $this->pic2 = $pic2;
    }

    //$name $age $breed $size $sex $status $altered m$hasShots $houseTrained $description $pic1 $pic2
}

?>