<?php

/**
 * Met à jour la base de données pour réserver une salle
 */

// Modification de l'entête
header('Content-Type: application/json');

// Connexion à la base de donnée
require_once '../connexion.php';

// Récupère et décode la requête POST en JSON
$room = json_decode(file_get_contents('php://input'));

if (!empty($room->roomId)) {
    // Met à jour la salle selon son ID
    $query = $db->prepare('UPDATE rooms SET isReserved = true WHERE id = :id');
    $query->bindValue(':id', $room->roomId);
    $query->execute();

    echo json_encode([
        'success' => true
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'La salle à réservé n\'existe pas'
    ]);
}

