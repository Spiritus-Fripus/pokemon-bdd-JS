<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokemon";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = 
    "SELECT DISTINCT * 
    FROM pokemon 
    INNER JOIN pokemon_type ON pokemon.pok_id = pokemon_type.pokt_pok_id 
    INNER JOIN type ON pokemon_type.pokt_typ_id = type.typ_id 
    INNER JOIN pokemon_stat ON pokemon.pok_id = pokemon_stat.pokstat_pok_id 
    INNER JOIN statistique ON pokemon_stat.pokstat_stat_id = statistique.stat_id
    GROUP BY pok_name 
    ORDER BY pok_id 
    " ;
$result = $conn->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);


$conn->close();
?>
