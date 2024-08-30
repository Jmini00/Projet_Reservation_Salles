<?php

/**
 * Sélectionne toutes les salles réservées
 */
require_once '../connexion.php';

$query = $db->query('SELECT * FROM rooms WHERE isReserved = true');
$rooms = $query->fetchAll();

header('Content-Type: application/json');
echo json_encode($rooms);
