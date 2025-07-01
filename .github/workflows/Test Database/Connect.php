<?php

$serverName = "DESKTOP-9KB44HF\SQLEXPRESS";
$connectionOptions = [
    "Database"=>"EMPLOYEE",
    "Uid"=>"",
    "PWD"=>""
    ];

$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) {
    die("Erreur de connexion : " . print_r(sqlsrv_errors(), true));
}

/*

$sql = "INSERT INTO students (NAME,EMAIL,GRADE) VALUES ('Jhon Doe','JhonDoe@gmail.com','B')";
$results = sqlsrv_query($conn,$sql);

if($results)
    echo 'Data Insertion Success';
else
    echo 'Insertion ERROR';

*/

?>