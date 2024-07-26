<?php


class Package{

    private $pharname;

    public function __construct($pharname){
        $this->pharname = $pharname;
    }

    public function pharPackage(){
        $phar = new Phar("$this->pharname");
    }
}