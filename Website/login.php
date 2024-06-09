<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_moderationtrain";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailClient = $_POST['emailClient'];
    $passwordClient = $_POST['passwordClient'];

    $sql = "SELECT * FROM utilisateurs WHERE emailClient = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emailClient);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($passwordClient, $user['passwordClient'])) {
            //echo "Connexion réussie!";
             // Rediriger l'utilisateur vers une page appropriée après connexion réussie
            header("Location: reservation.html");
            //exit();

        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun compte trouvé avec cet email.";
    }

    $stmt->close();
}

$conn->close();
?>