<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_moderationtrain";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupération des données du formulaire
$from_station = $_POST['from_station'];
$to = $_POST['to_station'];
$hour_departure = $_POST['hour_departure'];
$hour_arrival = $_POST['hour_arrival'];
$duration = $_POST['duration'];
$price = $_POST['price'];
$passengers = $_POST['passengers'];

// Insertion des données dans la base de données
$sql = "INSERT INTO reservations (from_station, to_station, travel_date, passengers, quiet_seat, power_socket, extra_luggage, sms_info, cancellation_guarantee) 
        VALUES ('$from_station', '$to_station', '$hour_departure', '$hour_arrival', '$duration', '$price', '$passengers')";

if ($conn->query($sql) === TRUE) {
    echo "Réservation enregistrée avec succès !";
} else {
    echo "Erreur lors de l'enregistrement de la réservation : " . $conn->error;
}

$conn->close();
?>