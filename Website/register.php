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
    $nomClient = $_POST['nomClient'];
    $prenomClient = $_POST['prenomClient'];
    $ageClient = $_POST['ageClient'];
    $villeClient = $_POST['villeClient'];
    $telephoneClient = $_POST['telephoneClient'];
    $emailClient = $_POST['emailClient'];
    $passwordClient = password_hash($_POST['passwordClient'], PASSWORD_BCRYPT);

    // Vérifier si l'adresse e-mail existe déjà dans la base de données
    $email_exist = false;
    $sql = "SELECT * FROM utilisateurs WHERE emailClient = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emailClient);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $email_exist = true;
    }

    $stmt->close();

    if ($email_exist) {
        echo "Cet e-mail est déjà enregistré.";
    } else {
        // Insérer le nouvel utilisateur dans la base de données
        $sql = "INSERT INTO utilisateurs (nomClient, prenomClient, ageClient, villeClient, telephoneClient, emailClient, passwordClient) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisss", $nomClient, $prenomClient, $ageClient, $villeClient, $telephoneClient, $emailClient, $passwordClient);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Inscription réussie!";
            header("Location: index.html");
            exit();
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>