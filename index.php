<?php
/**
 * Includes required files
 */
include_once('./Config/config.php');
include_once('./Class/Employees.php');
include_once('./Model/Database.php');
include_once('./Class/Ajax.php');
global $db,$emp;

$db = new Database();
$emp = new Employees();

if(isset($_REQUEST['action'])){
    
    $ajax = new Ajax();
    if($_REQUEST['action'] == 'get_list'){
        $data = $ajax->get_list();
        die();
    } else if($_REQUEST['action'] == 'emp_data_save'){
        $data = $ajax->emp_data_save();
        die();
    } else if($_REQUEST['action'] == 'get_emp_details'){
        $data = $ajax->get_emp_details();
        die();
    }else if($_REQUEST['action'] == 'delete_emp'){
        $data = $ajax->delete_emp();
        die();
    }

}

$emp->home();


?>