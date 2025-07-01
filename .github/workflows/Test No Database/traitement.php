<?php
// traitement.php

header('Content-Type: application/json');

// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['name'],$data['famillyname'])  || empty(trim($data['name']) And trim($data['famillyname']))) {
    echo json_encode([
        "success" => false,
        "message" => "L'un des champs est vide."
    ]);
    exit;
}

$prenom = htmlspecialchars(trim($data['name']));
$nom = htmlspecialchars(trim($data['famillyname']));

echo json_encode([
    "success" => true,
    "message" => "Bonjour, $prenom, $nom !"
]);
