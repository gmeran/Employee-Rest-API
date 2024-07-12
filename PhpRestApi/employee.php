<?php
    class Employee
    {
        
        public function getAllEmployees()
        {
            global $db;
            $query = "SELECT * FROM employee";
            $statement = $db->prepare($query);
            $statement->execute();
            $employees = $statement->fetchAll();
            return $employees;
        }

        public function getEmployeeByID($id)
        {
            global $db; 
            $query = "SELECT * FROM employee WHERE id= :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id',$id);
            $statement->execute();
            $employee = $statement->fetch();
            return $employee;
        }

        public function addEmployee($data)
        {
            global $db;
            $emp_name = $data['emp_name'];
            $emp_code = $data['emp_code'];
            $emp_email = $data['emp_email'];
            $emp_phone = $data['emp_phone'];
            $emp_address = $data['emp_address'];
            $emp_designation = $data['emp_designation'];
            $emp_joining_date = $data['emp_joining_date'];
            $query = "INSERT INTO employee(emp_name,emp_code,emp_email,emp_phone,emp_address,emp_designation,emp_joining_date)
                      VALUES('$emp_name','$emp_code','$emp_email','$emp_phone','$emp_address','$emp_designation','$emp_joining_date')";
            $statement= $db ->prepare($query);
            if($statement)
            {
                $statement->execute();
                return true;
            } else
            {
                return false;
            }
            
        }

        public function updateEmployee($id, $data)
        {
            global $db;
            $emp_name = $data['emp_name'];
            $emp_code = $data['emp_code'];
            $emp_email = $data['emp_email'];
            $emp_phone = $data['emp_phone'];
            $emp_address = $data['emp_address'];
            $emp_designation = $data['emp_designation'];
            $emp_joining_date = $data['emp_joining_date'];
            $query = "UPDATE employee SET emp_name = '$emp_name' ,emp_code = '$emp_code',emp_email = '$emp_email',emp_phone = '$emp_phone',emp_address = '$emp_address',emp_designation = '$emp_designation',emp_joining_date = '$emp_joining_date' WHERE id = :id";         
            $statement= $db->prepare($query);
            $statement ->bindValue(':id',$id);
            if($statement)
            {
                $statement->execute();
                return true;
            } else
            {
                return false;
            }
            
        }

        public function deleteEmployee($id)
        {
            global $db;
            $query = "DELETE FROM employee WHERE id = :id ";
            $statement = $db->prepare($query);
            $statement -> bindValue(':id',$id);
            if($statement)
            {
                $statement->execute();
                return true;
            } else
            {
                return false;
            }
        }

    }
?>