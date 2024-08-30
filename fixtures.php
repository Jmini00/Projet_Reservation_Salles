<?php

require_once 'vendor/autoload.php';
require_once 'connexion.php';

$faker = Faker\Factory::create();

for ($i = 0; $i < 30; $i++) {
    $query = $db->prepare("INSERT INTO rooms (name, picture, capacity, isReserved) VALUES (:name, :picture, :capacity, :isReserved)");
    $query->bindValue(':name', $faker->word);
    $query->bindValue(':picture', 'https://picsum.photos/450');
    $query->bindValue(':capacity', $faker->numberBetween(10, 100), PDO::PARAM_INT);
    $query->bindValue(':isReserved', false, PDO::PARAM_BOOL);
    $query->execute();
}

echo "Les salles ont bien été insérées";
