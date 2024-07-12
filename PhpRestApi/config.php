<?php
    $dsn = 'mysql:host=localhost;dbname=employee_management';
    $username = 'root';

    try{
        $db = new PDO($dsn,$username);
    } catch(PDOException $e)
    {
        $error = 'Database Error: ';
        $error .= $e->getMessage();
        echo($error);
    }

?>