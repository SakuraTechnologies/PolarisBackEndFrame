<?php


class Package{

    private $pharname;

    public function __construct($pharname){
        $this->pharname = $pharname;
        $this->pharPackage();
    }

    public function pharPackage(){
        new Phar("$this->pharname");
    }
}