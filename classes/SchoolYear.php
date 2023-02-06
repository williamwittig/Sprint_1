<?php

class SchoolYear {
    private $_year;
    private $_fallNotes;
    private $_winterNotes;
    private $_springNotes;
    private $_summerNotes;
    private $_render;

    public function __construct($year, $fall = "", $winter = "", $spring = "", $summer = "", $render = false) {
        $this->_year = $year;
        $this->_fallNotes = $fall;
        $this->_winterNotes = $winter;
        $this->_springNotes = $spring;
        $this->_summerNotes = $summer;
        $this->_render = $render;
    }

    // Getters
    public function getYear() {
        return $this->_year;
    }
    public function getFallNotes() {
        return $this->_fallNotes;
    }
    public function getWinterNotes() {
        return $this->_winterNotes;
    }
    public function getSpringNotes() {
        return $this->_springNotes;
    }
    public function getSummerNotes() {
        return $this->_summerNotes;
    }
    public function shouldRender() {
        return $this->_render;
    }

    // Setters
    public function setFallNotes($fall) {
        $this->_fallNotes = $fall;
    }
    public function setWinterNotes($winter) {
        $this->_winterNotes = $winter;
    }
    public function setSpringNotes($spring) {
        $this->_springNotes = $spring;
    }
    public function setSummerNotes($summer) {
        $this->_summerNotes = $summer;
    }
    public function setRender($render) {
        $this->_render = $render;
    }
    
}