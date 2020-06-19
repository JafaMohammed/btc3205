<?php
//we create
interface Crud{
    /* All these methods have to be implemented by any class that implement 
    these interfaces*/
    public function save($conn,$path);
    public function readAll($conn);
    public function readUnique();
    public function search();
    public function update();
    public function removeOne();
    public function removeAll();
    public function validateForm();
    public function createFormErrorSessions();
}
?>






