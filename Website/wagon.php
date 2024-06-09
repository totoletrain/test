<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_moderationtrain";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : ". $conn->connect_error);
}

// Récupérer la place sélectionnée
$place = $_POST['place'];

// Vérifier si la place est valide
if (isset($place) &&!empty($place)) {
    // Enregistrer la place dans la base de données
    $sql = "INSERT INTO reservations (place) VALUES ('$place')";
    $result = $conn->query($sql);

    if ($result) {
        $message = "La place ". $place. " a été enregistrée avec succès!";
        $style = "success";
    } else {
        $message = "Erreur lors de l'enregistrement de la place : ". $conn->error;
        $style = "error";
    }
} else {
    $message = "Aucune place sélectionnée";
    $style = "error";
}

// Fermer la connexion
$conn->close();

// Afficher le message
echo "<div style='position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url(\"train-background.jpg\"); background-size: cover;'>";

echo "<div class='message $style' style='position: relative; top: 6%; left: 50%; transform: translate(-50%, -50%); text-align: center;'>";
echo "<h2 style='font-weight: bold; font-size: 24px;'>$message</h2>";
echo "</div>";
echo "<br><br>";
echo "<div style='text-align: center;'>";
echo "<a href='panier.php'><button type='button' style='
  padding: 15px;
  background: #28a745;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.3s ease;
  font-size: 16px;
'>Voir mon panier</button></a>";
echo "</div>";
echo "</div>";

// CSS pour styliser les messages
echo "<style>
  .message {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
  .success {
        background-color: #c6efce;
        border-color: #3e8e41;
        color: #3e8e41;
    }
  .error {
        background-color: #f2dede;
        border-color: #a94442;
        color: #a94442;
    }
</style>";
?>