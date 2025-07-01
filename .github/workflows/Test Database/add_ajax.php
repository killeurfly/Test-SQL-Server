<?php
header('Content-Type: application/json');
require_once 'Connect.php';

$data = json_decode(file_get_contents("php://input"), true);

// Fonction pour récupérer la liste des étudiants
function getStudentsList($conn) {
    $result = sqlsrv_query($conn, "SELECT ID, NAME, EMAIL, GRADE FROM students ORDER BY ID DESC");
    $students = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $students[] = $row;
    }
    return $students;
}

// Si données envoyées valides, on insère
if (
    $data &&
    !empty($data['name']) &&
    !empty($data['email']) &&
    !empty($data['grade'])
) {
    $name = $data['name'];
    $email = $data['email'];
    $grade = $data['grade'];

    $sql = "INSERT INTO students (NAME, EMAIL, GRADE) VALUES (?, ?, ?)";
    $params = [$name, $email, $grade];
    $stmt = sqlsrv_query($conn, $sql, $params);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Erreur d'insertion"]);
        exit;
    }

    $students = getStudentsList($conn);
    echo json_encode([
        "success" => true,
        "message" => "Étudiant ajouté",
        "students" => $students
    ]);
    exit;
}

// Sinon (pas d’insertion), on renvoie juste la liste
$students = getStudentsList($conn);
echo json_encode([
    "success" => true,
    "message" => "Liste chargée",
    "students" => $students
]);
