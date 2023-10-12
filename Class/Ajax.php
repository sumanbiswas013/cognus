<?php
class Ajax{
    public function get_list(){
        global $emp;
        echo $emp->list();
        die();
    }

    public function emp_data_save(){
        global $db;
        $fname = $_POST['emp_first_name'];
        $lname = $_POST['emp_last_name'];
        $email = $_POST['emp_email'];
        $designation = $_POST['emp_designation'];
        
        $data = '';
        $emp_id = $_POST['emp_id'];
        if($emp_id){
            $data = $db->updateEmp($emp_id,$fname,$lname,$designation);
        }else{
            $data = $db->insertEmp($fname,$lname,$email,$designation);
        }
        echo json_encode($data);
        die();
    }

    public function get_emp_details(){
        global $db;
        $emp_id = $_POST['emp_id'];
        $data = $db->fetchEmpRow($emp_id);
        echo json_encode($data);
        die();
    }

    public function delete_emp(){
        global $db;
        $emp_id = $_POST['emp_id'];
        $data = $db->deleteEmp($emp_id);
        echo json_encode($data);
        die();
    }
}


?>