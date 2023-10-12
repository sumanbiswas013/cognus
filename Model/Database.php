<?php
/**
 * This class will responsible for all kind of database query
 */
Class Database{

    public $connection;

    public function __construct(){
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $this->create_default_tables();        
        
    }

    public function __destruct() {
        $this->connection->close();
    }

    public function create_default_tables(){
        $sql = "CREATE DATABASE IF NOT EXISTS ".DB_NAME;
        if($this->connection->query($sql)){
            $this->connection->select_db(DB_NAME);
            $emp_personal_query = "CREATE TABLE IF NOT EXISTS `emp_personal` (
                    `emp_id` int NOT NULL AUTO_INCREMENT COMMENT 'Employee ID',
                    `emp_fname` varchar(100) NOT NULL COMMENT 'First Name',
                    `emp_lname` varchar(100) NOT NULL COMMENT 'Last Name',
                    `emp_email` varchar(200) NOT NULL COMMENT 'Email Address',
                    `emp_created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created Date time',
                    PRIMARY KEY (`emp_id`),
                    UNIQUE KEY `emp_email` (`emp_email`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";

            $this->connection->query($emp_personal_query);

            $emp_designation_query = "CREATE TABLE IF NOT EXISTS `emp_designation` ( `emp_id` INT(11) NOT NULL , `designation` varchar(100) NOT NULL , UNIQUE (`emp_id`)) ENGINE = InnoDB";

            $this->connection->query($emp_designation_query);
        }else{
            $this->connection->select_db(DB_NAME);
        }
        

        
    }

    public function insertEmp($fname,$lname,$email,$designation){
        $data = array();

        $select = $this->connection->prepare("SELECT emp_id FROM emp_personal WHERE emp_email=?");
        $select->bind_param("s", $email);
        $select->execute();
        $result = $select->get_result();

        if($result->num_rows == 0){
            $sql = $this->connection->prepare("INSERT INTO emp_personal (emp_fname, emp_lname, emp_email) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $fname, $lname, $email);
            if ($sql->execute()) {
                $last_id = $this->connection->insert_id;

                
                $designation_sql = $this->connection->prepare("INSERT INTO emp_designation (emp_id, designation) VALUES (?, ?)");
                $designation_sql->bind_param("is", $last_id, $designation);
                $designation_sql->execute();
                $data['id'] = $last_id;
                $data['message'] = 'Data saved successfully';
                $data['status'] = 200;
            }  
        }else{
            $data['id'] = 0;
            $data['message'] = 'Duplicate email address';
            $data['status'] = 201;
        }
        return $data;
    }

    public function updateEmp($emp_id,$fname,$lname,$designation){
        $data = array();

        $select = $this->connection->prepare("SELECT emp_id FROM emp_personal WHERE emp_id=?");
        $select->bind_param("i", $emp_id);
        $select->execute();
        $result = $select->get_result();

        if($result->num_rows ==  1){
            $sql = $this->connection->prepare("UPDATE emp_personal SET emp_fname = ? , emp_lname = ? WHERE emp_id = ?");
            $sql->bind_param("ssi", $fname, $lname, $emp_id);
            if ($sql->execute()) {
                          
                $designation_sql = $this->connection->prepare("UPDATE emp_designation SET  designation = ? WHERE emp_id= ?");
                $designation_sql->bind_param("si", $designation,$emp_id);
                $designation_sql->execute();
                $data['id'] = $emp_id;
                $data['message'] = 'Data saved successfully';
                $data['status'] = 200;
            }  
        }else{
            $data['id'] = 0;
            $data['message'] = 'Invalid user';
            $data['status'] = 201;
        }
        return $data;
    }

    public function deleteEmp($emp_id){
        $sql = $this->connection->prepare("DELETE FROM emp_personal WHERE emp_id = ?");
        $sql->bind_param("i", $emp_id);
        $sql->execute();

        $sql = $this->connection->prepare("DELETE FROM emp_designation WHERE emp_id = ?");
        $sql->bind_param("i", $emp_id);
        $sql->execute();

        $data = array();
        $data['id'] = $emp_id;
        $data['message'] = 'Data removed successfully';
        $data['status'] = 200;
        return $data;
    }

    public function fetchEmpRow($emp_id){
        $sql = "SELECT ep.emp_id,ep.emp_fname,ep.emp_lname,ep.emp_email,ed.designation FROM emp_personal as ep JOIN emp_designation as ed ON ep.emp_id = ed.emp_id AND ep.emp_id={$emp_id}";
        $result = $this->connection->query($sql);
        $row = $result->fetch_row();
        $result->free_result();
        return $row;
    }

    public function fetchAllEmp(){
        $sql = "SELECT ep.emp_id,ep.emp_fname,ep.emp_lname,ep.emp_email,ed.designation FROM emp_personal as ep JOIN emp_designation as ed ON ep.emp_id = ed.emp_id ORDER BY ep.emp_created_on DESC";
        $result = $this->connection->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        return $row;
    }
}
?>