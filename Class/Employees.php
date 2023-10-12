<?php
Class Employees{

    /**
     * construct the class
     */
    public function __construct(){

    }

    public function home(){
        include_once('Views/Home/home.php');
    }

    /**
     * List the employees
     */
    public function list(){
        global $db;
        $all_data = $db->fetchAllEmp();
        include_once('Views/List/list.php');
    }

    /**
     * Add new Employee
     */
    public function add(){

    }

    /**
     * Update Employee
     */
    public function update(){

    }

    /**
     * Delete Employee
     */
    public function delete(){
        
    }
}
?>