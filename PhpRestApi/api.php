<?php
    require_once 'config.php';
    require_once 'employee.php';

    $employeeObj = new Employee($db);

    $method = $_SERVER['REQUEST_METHOD'];

    $endpoint = $_SERVER["PATH_INFO"];

    header('Content-Type: application/json');

    switch($method)
    {
        case 'GET':
            if($endpoint === '/employees')
            {
                $employees = $employeeObj->getAllEmployees();
                echo json_encode($employees);
            } elseif(preg_match('/^\/employees\/(\d+)$/',$endpoint,$matches))
            {
                $employeeId = $matches[1];
                $employee = $employeeObj->getEmployeeByID($employeeId);
                echo json_encode($employee);

            }
            break;
        case 'POST':
            if($endpoint === '/employees')
            {
                $data = json_decode(file_get_contents('php://input'),true);
                $result = $employeeObj->addEmployee($data);
                echo json_encode(['success'=> $result]);   
            }
            break;
        case 'PUT':
            if (preg_match('/^\/employees\/(\d+)$/',$endpoint,$matches))
            {
                $employeeId= $matches[1];
                $data = json_decode(file_get_contents('php://input'),true);
                $result = $employeeObj->updateEmployee($employeeId,$data);
                echo json_encode(['success'=> $result]);   
            }
            break;
        case 'DELETE':
            if (preg_match('/^\/employees\/(\d+)$/',$endpoint,$matches))
            {
                $employeeId= $matches[1];
                $data = json_decode(file_get_contents('php://input'),true);
                $result = $employeeObj->deleteEmployee($employeeId,$data);
                echo json_encode(['success'=> $result]);   
            }
            break;
    }
    
?>