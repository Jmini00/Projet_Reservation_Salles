<?php

/**
 * Sélectionne toutes les salles
 */
require_once '../connexion.php';

$query = $db->query('SELECT * FROM rooms');
$rooms = $query->fetchAll();

header('Content-Type: application/json');
echo json_encode($rooms);
